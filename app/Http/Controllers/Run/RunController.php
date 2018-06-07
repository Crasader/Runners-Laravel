<?php

namespace App\Http\Controllers\Run;

use App\Run;
use App\Artist;
use App\Waypoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Runs\StoreNewRun;
use App\Http\Requests\Runs\UpdateRun;

/**
 * RunController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Run
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
        $this->authorize('view', Run::class);
        $runs = Run::filter($request, 'planned_at', 'asc')->paginate(20);
        return view('runs.index')->with(compact('runs', 'request'));
    }

    /**
     * Display the runs with special layout for big screens
     *
     * @return \Illuminate\Http\Response
     */
    public function big()
    {
        $this->authorize('view', Run::class);
        $runs = Run::whereDate('planned_at', '>', Carbon::now()->toDateString())
            ->orderBy('planned_at', 'asc')
            ->limit(30)
            ->get();
        return view('runs.big')->with(compact('runs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Run::class);
        return view('runs.create'); //->with(compact('waypoints', 'artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Runs\StoreNewRun  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewRun $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        return view('runs.show')->with(compact('run'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function edit(Run $run)
    {
        $this->authorize('update', $run);
        return view('runs.edit')->with(compact('run'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Runs\UpdateRun  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRun $request, Run $run)
    {
        $this->authorize('update', $run);
        // Check usage of add runner and add waypoint buttons
        if ($request->has('add-runner') && $request->input('add-runner', "false") === "true") {
            $run->newSubscription();
            return redirect()->action('Run\RunController@edit', ['run' => $run->id]);
        }
        if ($request->has('add-waypoint')) {
            $run->newWaypoint($request->input('add-waypoint'));
            dd($run->waypoints);
        }

        dd($request->all());
        //$run->saveDatas($request->all());
        // Save the run datas
        // Save the artist and waypoints linked to the run
        // Save the run drivers
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run)
    {
        //
    }

    /**
     * Ends the run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function publish(Run $run)
    {
        //
    }

    /**
     * Start the run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function start(Run $run)
    {
        //
    }

    /**
     * Ends the run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function stop(Run $run)
    {
        //
    }
}
