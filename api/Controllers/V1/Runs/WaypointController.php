<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 12.01.2017
 * Time: 13:44
 */

namespace Api\Controllers\V1\Runs;

use Api\Controllers\BaseController;
use Lib\Models\Run;
use Dingo\Api\Transformer\Adapter\Fractal;
use Illuminate\Http\Request;
use Api\Responses\Transformers\RunTransformer;
use Lib\Models\Waypoint;

class WaypointController extends BaseController
{
    public function index(Request $request)
    {
      return $this->response()->collection(Run::all(), new RunTransformer);
    }
    public function show(Request $request, Run $run)
    {
      return $run->waypoints;
    }
    public function deleteAll(Run $run)
    {
      //TODO implement broadcasting for waypoints
      $run->waypoints()->sync([]);
      return $run;
    }
    
    public function store(Request $request, Run $run)
    {
      if($request->has("waypoints")) {
        if($run->exists)//remove all waypoints and reassign them
          $run->waypoints()->sync([]);
        foreach($request->get("waypoints") as $point){
          if(empty($point)) continue;
          $run->waypoints()->attach(Waypoint::firstOrCreate(["name"=>$point]));
        }
      }
      
      return $run->waypoints;
    }
    
}
