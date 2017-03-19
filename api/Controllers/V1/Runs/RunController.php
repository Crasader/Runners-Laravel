<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 12.01.2017
 * Time: 13:44
 */

namespace Api\Controllers\V1\Runs;

use Api\Controllers\BaseController;
use App\Http\Requests\CreateRunRequest;
use Carbon\Carbon;
use Lib\Models\Run;
use Lib\Models\RunSubscription;
use Dingo\Api\Transformer\Adapter\Fractal;
use Illuminate\Http\Request;
use Api\Responses\Transformers\RunTransformer;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class RunController extends BaseController
{
    public function index(Request $request)
    {
      return $this->response()->collection(Run::all(), new RunTransformer);
    }
    public function show(Request $request, Run $run)
    {
      return $run;
    }

    public function update(Request $request, Run $run)
    {
        $run->update($request->all());
        return $this->response()->accepted();
    }
    public function store(CreateRunRequest $request)
    {
        $run = new Run;
        $sub = new RunSubscription;
        $run->waypoints()->attach($request->get("waypoints"));

        if($request->has("runners"))
        {

          $runners = $request->get("runners");
          foreach($runners as $runner){
            $sub->users()->attach($runner);
          }
        }
        if($request->has("car_types"))
        {
          $types = $request->get("car_types");
          foreach($types as $type){
            $sub->car_types()->attach($type);
          }
        }
        if($request->has("cars"))
        {
          $cars = $request->get("cars");
          foreach($cars as $car){
            $sub->cars()->attach($car);
          }
        }
        $run->fill($request->except(["_token","token"]));
        $run->subscriptions()->save($sub);
        $run->save();
        return $this->response()->created();
    }
    public function delete(Run $run)
    {
      $run->delete();
        return $this->response->accepted();
    }
    public function start(Request $request,Run $run)
    {
      //check all subscriptions if they are good
        foreach($run->subscriptions as $sub)
        {
            if(!$sub->has("car") && $sub->has("user"))
               throw new NotAcceptableHttpException("All runners have not been filled, please fill run subscription $sub->id");
        }
        $run->started_at = Carbon::now();
        return $this->response->accepted();

    }
    public function stop(Request $request, Run $run)
    {
      $run->delete();//deleting the model will populate ended_at field, and archive it
      return $this->response->accepted();
    }
}
