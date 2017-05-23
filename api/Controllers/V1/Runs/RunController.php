<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 12.01.2017
 * Time: 13:44
 */

namespace Api\Controllers\V1\Runs;

use Api\Controllers\BaseController;
use Api\Requests\ListRunRequest;
use Api\Requests\SearchRequest;
use App\Events\RunDeletedEvent;
use App\Events\RunStartedEvent;
use App\Events\RunStoppedEvent;
use App\Events\RunSubscriptionCreatedEvent;
use App\Events\RunSubscriptionDeletedEvent;
use App\Events\RunSubscriptionSavedEvent;
use App\Events\RunSubscriptionUpdatedEvent;
use App\Events\RunUpdatedEvent;
use App\Http\Requests\CreateRunRequest;
use Carbon\Carbon;
use Lib\Models\Run;
use Lib\Models\RunSubscription;
use Dingo\Api\Transformer\Adapter\Fractal;
use Illuminate\Http\Request;
use Api\Responses\Transformers\RunTransformer;
use Lib\Models\Waypoint;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RunController extends BaseController
{
    public function index(ListRunRequest $request)
    {
      $query = new Run;
      $query = $query->newQuery();
      if($request->has("between")) {
        $dates = explode(",",$request->get("between"));
        $query->whereBetween("planned_at", $dates);
      }
      if($request->has("actif"))
        $query->actif();//retrive all active runs @see Lib\Models\Run::scopeActif
      if($request->has("status"))
        $query->ofStatus($request->get("status"));
      if($request->has("sortBy")){
          $sorts = explode(",",$request->get("sortBy"));
          foreach($sorts as $sort){
              $t = explode(":",$sort);
              $column = trim($t[0]);
              if(count($t)==2)
                  $sorting = trim($t[1]);
              else
                  $sorting = "ASC";//default sorting
              $query->orderBy($column,$sorting);
          }
      }
      if(!$request->has("finished"))
        $query->notOfStatus("finished");
      return $this->response()->collection($query->get(), new RunTransformer);
    }
    public function search(SearchRequest $request)
    {
      $query = $request->get("q","");
      return Run::where("name","like","%$query%")->get();
    }
    public function show(Request $request, Run $run)
    {
      return $run;
    }

    public function update(Request $request, Run $run)
    {
        $run->fill($request->all());
        $subs = [];
        if($request->has("subscriptions")) {
          $t = collect($request->get("subscriptions", []));
          $run->subscriptions()->whereNotIn("id",$t->pluck("id")->filter(function($i){return !is_null($i);}))->get()->each(function(RunSubscription $sub) use ($t){
            // if(!$t->contains("id",$sub->id))
              $sub->forceDelete();
          });//reset the subscriptions of a run

          foreach ($request->get("subscriptions", []) as $convoy) {
            $userId = array_key_exists("user", $convoy) ? $convoy["user"] : null;
            $carId = array_key_exists("car", $convoy) ? $convoy["car"] : null;
            $carTypeId = array_key_exists("car_type", $convoy) ? $convoy["car_type"] : null;
            $sub = array_key_exists("id", $convoy) ? RunSubscription::findOrFail($convoy["id"]) : new RunSubscription;
            $sub->user()->associate($userId);
            $sub->car()->associate($carId);
            $sub->car_type()->associate($carTypeId);
            if($sub->exists) {
              $sub->save();
              broadcast(new RunSubscriptionUpdatedEvent($sub));
            }
            else{
              $sub->run()->associate($run);
              $subs[] = $sub;
            }
          }
        }
        if($request->has("waypoints")) {
          $run->waypoints()->sync([]);//remove all waypoints and reassign them
          foreach($request->get("waypoints") as $point){
            $run->waypoints()->attach(Waypoint::firstOrCreate(["name"=>$point]));
          }

        }
        dump("saving");
        $run->save();
        foreach($subs as $s){
          $s->save();
          broadcast(new RunSubscriptionCreatedEvent($s));
        }
        broadcast(new RunUpdatedEvent($run));
        return $run;
    }
    protected function addSubsToRun(Request $request, Run $run)
    {
      //TODO implement this method, just to DRY up codebase
    }
    public function store(CreateRunRequest $request)
    {
        $run = new Run;
        $subs = [];

        foreach($request->get("subscriptions",[]) as $convoy)
        {
          $userId = array_key_exists("user",$convoy) ? $convoy["user"] : null;
          $carId = array_key_exists("car",$convoy) ? $convoy["car"] : null;
          $carTypeId = array_key_exists("car_type",$convoy) ? $convoy["car_type"] : null;
          $sub = new RunSubscription;
          $sub->user()->associate($userId);
          $sub->car()->associate($carId);
          $sub->car_type()->associate($carTypeId);
          $subs[] = $sub;
        }

        $run->fill($request->except(["_token","token"]));
        if($run->name == null)
          $run->name =  $request->get("title",$request->get("artist", null));

        $run->save();
        //save relationships
        if(count($subs))
          $run->subscriptions()->saveMany($subs);

        foreach($request->get("waypoints") as $point){
          $run->waypoints()->attach(Waypoint::firstOrCreate(["name"=>$point]));//need to attach 1 by 1 to calculate order
        }


      return $run;
      //return $this->response->item($run, new RunTransformer);
        //return $this->response()->created($content=$run);
    }
    public function destroy(Run $run)
    {
        $run->ended_at = Carbon::now();
        $run->save();
        broadcast(new RunDeletedEvent($run));
        $run->delete();
        return $run;
    }
    public function start(Request $request,Run $run)
    {
      //check all subscriptions if they are good
        if(!$this->user()->can("force run start"))
        {
          foreach($run->subscriptions as $sub)
          {
            if(($sub->car_id == null || $sub->user_id == null) || ($sub->car_id != null || $sub->user_id == null) || ($sub->car_id == null || $sub->user_id != null))
              throw new NotAcceptableHttpException("All runners have not been filled, please fill run subscription $sub->id");
          }
        }
        
//        $seats = $run->subscriptions->map(function($sub){
//          return $sub->car->nb_place;
//        })->sum();
//        if($seats < $run->nb_passenger)
//          throw new NotAcceptableHttpException("The run cannot start because number you don't have enough seats avaiable ($seats) in cars (needed : {$run->nb_passenger} )");
        $run->started_at = Carbon::now();
        $run->status="gone";
        $run->subscriptions->each(function($sub) use($run){
          $sub->status = "gone";
          $sub->started_at = $run->started_at;
          $sub->save();
        });
        $run->save();
      //TODO: rethink where to put this event
      //notify the run has started, this will triger observers that will put every utalised car and runner on "gone" status
        event(new RunStartedEvent($run));
        broadcast(new RunUpdatedEvent($run));
        return $run;

    }
    protected function terminateRun(Run $run){
      $run->ended_at = Carbon::now();
      $run->status="finished";
      $run->subscriptions->each(function($sub){
        $sub->status = "finished";
        $sub->ended_at = Carbon::now();
        $sub->save();
        $sub->delete();
        broadcast(new RunSubscriptionDeletedEvent($sub));
      });
      $run->save();
      event(new RunStoppedEvent($run));
      // broadcast(new RunUpdatedEvent($run));
      // $run->delete();
    }
    public function stop(Request $request, Run $run)
    {
      $user = $this->user();
      if(!$user->can("end run"))
        throw new UnauthorizedHttpException("You are not allowed to finish a run");
      
      if($user->can("force run end"))
        $this->terminateRun($run);
      else{
        $sub = $run->subscriptions()->whereHas("user",function($q) use($user){return $q->where("users.id",$user->id);})->first();
        if($sub != null)
        {
          $sub->status = "finished";
          $sub->save();
          return false;//terminate the loop
        }
        if($run->subscriptions->every(function($sub){
          return $sub->status == "finished";
        }))
          $this->terminateRun($run);
      }
      return $run;
    }
}
