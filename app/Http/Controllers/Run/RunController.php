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
            ->whereNotIn('status', ['finished', 'drafting'])
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
        $run = Run::create(['status' => 'drafting']);
        $run->waypoints()->attach(1, ['order' => 1]);
        return redirect()
            ->route('runs.edit', ['run' => $run->id])
            ->with('success', "Le run à correctement été crée");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Runs\StoreNewRun  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewRun $request)
    {
        //
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

        // Check usage of action buttons on the form
        if ($this->checkFormActions($request, $run)) {
            return redirect()->action('Run\RunController@edit', ['run' => $run->id])->withInput();
        }

        // Save alle the run datas and related datas
        $run->saveDatas($request->all());

        return redirect()
            ->route('runs.show', ['run' => $run->id])
            ->with('success', "Le run à correctement été mis a jour.");
    }

    /**
     * Check if actions buttons are used in the view (add waypoint, add run)
     *
     * @param  \App\Http\Requests\Runs\UpdateRun  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function checkFormActions($request, $run)
    {
        // Check runners addition
        if ($request->has('add-runner') && $request->input('add-runner', "false") === "true") {
            $run->newSubscription();
            return true;
        }
        // Check runners deletion
        if ($request->has('remove-runner')) {
            $run->removeSubscription($request->input('remove-runner'));
            return true;
        }
        // Check waypoints additions
        if ($request->has('add-waypoint')) {
            $run->newWaypoint($request->input('add-waypoint'));
            return true;
        }
        // Check waypoints removes
        if ($request->has('remove-waypoint')) {
            $run->removeWaypoint($request->input('remove-waypoint'));
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run)
    {
        $this->authorize('delete', $run);
        $run->subscriptions->each(function ($sub) {
            $sub->delete();
        });
        $run->waypoints()->detach();
        $run->artists()->detach();
        $run->delete();
        return redirect()
            ->route('runs.index')
            ->with('success', "Le run $run->name à bien été supprimé.");
    }

    /**
     * Ends the run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function publish(Run $run)
    {
        $this->authorize('update', $run);
        $run->publish();
        return redirect()
            ->back()
            ->with('success', "Le run $run->name à bien été publié, il est maintenant visible depuis l'app mobile.");
    }

    /**
     * Start the run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function start(Run $run)
    {
        $this->authorize('start', $run);
        $run->start();
        return redirect()
            ->back()
            ->with('success', "Le run $run->name à bien été démarré !");
    }

    /**
     * Ends the run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function stop(Run $run)
    {
        $this->authorize('stop', $run);
        $run->stop();
        return redirect()
            ->back()
            ->with('success', "Le run $run->name à bien été arrété !");
    }

    /**
     * Force the start of a run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function forceStart(Run $run)
    {
        $this->authorize('forceStart', $run);
        $run->forceSart();
        return redirect()
            ->back()
            ->with('warning', "Vous avez forcé le run $run->name à démarrer, malgré des informations manquantes !");
    }

    /**
     * Force the end of a run
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function forceStop(Run $run)
    {
        $this->authorize('forceStop', $run);
        $run->forceStop();
        return redirect()
            ->back()
            ->with('warning', "Vous avez forcé le run à s'arreter !");
    }
}
