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
use App\Http\Requests\PublishRunRequest;
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
  /**
   * Retrieve all runs
   * @param ListRunRequest $request
   * @return \Dingo\Api\Http\Response
   */
    public function index(ListRunRequest $request)
    {
      $query = new Run;
      $query = $query->newQuery();
      if($request->has("between")) {
//        $dates = explode(",",$request->get("between"));
//        $query->whereBetween("planned_at", $dates);
        $t = explode(",",$request->get("between"));
        $start = trim($t[0]);
        $end = trim($t[1]);
        $query->where("planned_at",">=",$start)->where("planned_at", "<",$end);
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
      //we filter the status finished=false, otherwise we don't need
      if( ! (int) filter_var($request->get("finished",false), FILTER_VALIDATE_BOOLEAN)) {
        $query->notOfStatus("finished");
      }
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
        $subs = $this->prepareSubscriptionsFromRequest($request, $run);
        
        if($request->has("waypoints")) {
          $run->waypoints()->sync([]);//remove all waypoints and reassign them
          foreach($request->get("waypoints") as $point){
            $run->waypoints()->attach(Waypoint::firstOrCreate(["name"=>$point]));
          }

        }

        foreach($subs as $s){
          $exists = $s->exists;
          $s->save();
        }
        $run->save();
        // broadcast(new RunUpdatedEvent($run));

        return $run;
    }
    protected function addSubsToRun(Request $request, Run $run)
    {
      //TODO implement this method, just to DRY up codebase
    }
    protected function prepareSubscriptionsFromRequest(Request $request, $run)
    {
      $subs = [];
      if($request->has("subscriptions")) {
        $t = collect($request->get("subscriptions", []));
        $run->subscriptions()->whereNotIn("id",$t->pluck("id")->filter())->get()->each(function(RunSubscription $sub){
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
      return $subs;
    }
    public function store(CreateRunRequest $request)
    {
        $run = new Run;
        $subs = $this->prepareSubscriptionsFromRequest($request, $run);
        
        $run->fill($request->except(["_token","token"]));
        if($run->name == null)
          $run->name =  $request->get("title",$request->get("artist", null));
        $run->save();
        //save relationships
        foreach($subs as $s){
          $exists = $s->exists;
          $s->save();
        }
        foreach($request->get("waypoints") as $point){
          $run->waypoints()->attach(Waypoint::firstOrCreate(["name"=>$point]));//need to attach 1 by 1 to calculate order
        }
      return $run;
      //return $this->response->item($run, new RunTransformer);
        //return $this->response()->created($content=$run);
    }
    public function publish(PublishRunRequest $request, Run $run)
    {
      $subs = $this->prepareSubscriptionsFromRequest($request, $run);
      $run->fill($request->except(["_token","token"]));
      $run->publish();
      return $run;
    }
    public function destroy(Run $run)
    {
        $run->ended_at = Carbon::now();
        $run->save();
        
        $run->delete();
        return $run;
    }
    public function start(Request $request,Run $run)
    {
      //check all subscriptions if they are good
        if(!$this->user()->hasPermissionTo("force run start") && $run->status != "ready")
          throw new UnauthorizedHttpException("Not every convoy has been assigned");
        

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
        broadcast(new RunStartedEvent($run))->toOthers();
        // event(new RunUpdatedEvent($run));
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
        event(new RunSubscriptionDeletedEvent($sub));
      });
      \Log::debug("RUN STOPPED: status:".$run->status);
  
      $run->save();
      \Log::debug("RUN STOPPED: status:".$run->status);
      event(new RunStoppedEvent($run));
      // event(new RunUpdatedEvent($run));
      // $run->delete();
    }
    public function stop(Request $request, Run $run)
    {
      $user = $this->user();

      if(!$user->hasPermissionTo("end run"))
        throw new UnauthorizedHttpException("You are not allowed to finish a run");

      if($user->hasPermissionTo("force run end"))
        $this->terminateRun($run);
      else{
        $sub = $run->subscriptions()->whereHas("user",function($q) use($user){return $q->where("users.id",$user->id);})->first();
        if($sub != null)
        {
          $sub->status = "finished";
          $sub->save();
        }
        if($run->subscriptions()->ofStatus("finished")->count() == $run->subscriptions()->count())
          $this->terminateRun($run);
      }
      broadcast(new RunStoppedEvent($run))->toOthers();
      return $run;
    }
}
