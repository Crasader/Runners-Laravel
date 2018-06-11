<?php

namespace App\Http\Controllers\Waypoint;

use App\Waypoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Waypoints\StoreWaypoint;
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
        // Where to ignore temporary waypoints used in the run creation
        $waypoints = Waypoint::orderBy('name', 'asc')->whereNotIn('name', [''])->paginate(30);
        return view('waypoints.index')->with(compact('waypoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Waypoint::class);
        return view('waypoints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Waypoints\StoreWaypoint  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaypoint $request)
    {
        $this->authorize('create', Waypoint::class);
        Waypoint::create($request->all());
        return redirect()->route('waypoints.index')->with('success', "Le lieu a bien été ajouté.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function show(Waypoint $waypoint)
    {
        return view('waypoints.show')->with(compact('waypoint'));
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
            return response()->json(null, 204);
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
        $this->authorize('update', Waypoint::class);
        return view('waypoints.edit')->with(compact('waypoint'));
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
        $this->authorize('update', Waypoint::class);
        $waypoint->fill($request->all());
        $waypoint->save();
        return redirect()
            ->route('waypoints.show', ['waypoint' => $waypoint->id])
            ->with('success', "Le lieu a bien été modifié !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waypoint  $waypoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waypoint $waypoint)
    {
        $this->authorize('delete', Waypoint::class);
        $waypoint->delete();
        return redirect()
            ->route('waypoints.index')
            ->with('success', "Le lieu : {$waypoint->name} a bien été supprimé !");
    }
}
