<?php

namespace App\Http\Controllers\Waypoint;

use App\Waypoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\waypoints\WaypointSearchResource;

/**
 * WaypointController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Waypoint
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function show(Waypoint $waypoint)
    {
        //
    }

    /**
     * Search in the model, return json
     * This method is designed to be used with the search fields (see the search field component)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->needle) {
            // Case insensitive search
            $results = Waypoint::whereRaw('LOWER(`name`) LIKE ? ', [trim(strtolower($request->needle)).'%'])->get();
            return WaypointSearchResource::collection($results);
        } else {
            return response()->json(null, 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function edit(Waypoint $waypoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waypoint $waypoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waypoint $waypoint)
    {
        //
    }
}
