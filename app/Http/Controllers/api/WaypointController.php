<?php

namespace App\Http\Controllers\api;

use App\Waypoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\waypoints\WaypointCollection;
use App\Http\Resources\waypoints\WaypointResource;
use App\Http\Requests\StoreWaypoint;

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
        return new WaypointCollection(Waypoint::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaypoint $request)
    {
        $waypoint = new Waypoint($request->all());
        $waypoint->save();
        return (new WaypointResource($waypoint))->response()->setStatusCode(201);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function update(StoreWaypoint $request, Waypoint $waypoint)
    {
        $waypoint->fill($request->all());
        $waypoint->save();
        return new WaypointResource($waypoint);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waypoint $waypoint)
    {
        $waypoint->delete();
        return response()->json(null, 204);
    }
}
