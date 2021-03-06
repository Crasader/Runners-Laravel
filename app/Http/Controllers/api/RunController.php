<?php

namespace App\Http\Controllers\api;

use App\Run;
use App\RunSubscription;
use App\RunWaypoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\runs\RunCollection;
use App\Http\Resources\runs\RunResource;
use App\Http\Requests\StoreRun;

/**
 * RunController
 * Api ressource controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\api
 */
class RunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * If 'finished' is present in the query params
         */
        if ($request->has('finished') && ($request->query('finished') == 'true' || $request->query('finished') == 'false')) {
            // Return finished runs in the query param is true
            // the unfinished runs if the query is false
            return new RunCollection(
                Run::finished($request->query('finished'))
                ->withoutStatus('drafting')
                ->orderBy('planned_at', 'asc')
                ->with([
                    'waypoints',
                    'subscriptions.user',
                    'subscriptions.car',
                    'subscriptions.carType',
                    'subscriptions.car.type'
                ])->get()
            );

        /**
         * If 'status' is present in the query params
         */
        } elseif ($request->has('status')) {
            // Return the runs scoped by his status
            return new RunCollection(Run::whereStatus($request->query('status'))
            ->withoutStatus('drafting')
            ->orderBy('planned_at', 'asc')
            ->with([
                'waypoints',
                'subscriptions.user',
                'subscriptions.car',
                'subscriptions.carType',
                'subscriptions.car.type'
            ])->get());
        }

        $runs = new RunCollection(Run::withoutStatus('drafting')
            ->orderBy('planned_at', 'asc')
            ->with([
                'waypoints',
                'subscriptions.user',
                'subscriptions.car',
                'subscriptions.carType',
                'subscriptions.car.type'
            ])->get());
        // Reorder waypoints - they came up in the order in the table, which may be incorrect depending on how the run was organized
        foreach ($runs as $run)
        {
            $wpts = RunWaypoint::join('waypoints','waypoint_id','=','waypoints.id')->select('name')->where('run_id',$run->id)->orderBy('order')->get();
            foreach ($run->waypoints as $key => $wp)
                $wp->name = ($wpts[$key])->name;
        }
        return $runs;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        return new RunResource($run);
    }

    /**
     * Display the runs for the curently authenticated user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function myRuns(Request $request)
    {
        return new RunCollection($request->user()->runs);
    }

    /**
     * Start the run passed in parameters
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request, Run $run)
    {
        // Determine if the run is ready (car and user assigned, all is ok to run)
        if ($run->ready()) {
            // Run ready, chek the authorizations
            $this->authorize('start', $run);
            $run->start();
            return new RunResource($run);
        } else {
            // The run is not ready, we need the authorization to force the run start
            $this->authorize('forceStart', $run);
            $run->start();
            return new RunResource($run);
        }
        // The run cannot be started
        return response()->json(null, 405);
    }

    /**
     * Stop the run passed in parameters
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function stop(Request $request, Run $run)
    {
        // Determine if the run is ready (car and user assigned, all is ok to run)
        if ($run->started()) {
            // Run ready, chek the authorizations
            $this->authorize('stop', $run);
            $run->stop();
            return new RunResource($run);
        }
        // The run is not started
        return response()->json(null, 405);
    }
}
