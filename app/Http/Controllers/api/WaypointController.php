<?php

namespace App\Http\Controllers\api;

use App\Waypoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\waypoints\WaypointCollection;
use App\Http\Resources\waypoints\WaypointResource;

/**
 * WaypointController
 * Api ressource controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\api
 */
class WaypointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new WaypointCollection(Waypoint::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function show(Waypoint $waypoint)
    {
        return new WaypointResource($waypoint);
    }

    /**
     * Search the waypoints that match the needle (passed in the query string)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $needle = $request->q;
        return new WaypointCollection(Waypoint::where('name', 'like', "%$needle%")->get());
    }
}
