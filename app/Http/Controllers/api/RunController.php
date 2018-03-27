<?php

namespace App\Http\Controllers\api;

use App\Run;
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
            return new RunCollection(Run::finished($request->query('finished'))->get());
        
        /**
         * If 'status' is present in the query params
         */
        } elseif ($request->has('status')) {
            // Return the runs scoped by his status
            return new RunCollection(Run::whereStatus($request->query('status'))->get());
        }

        // Return all the runs, if no query params
        return new RunCollection(Run::all());
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
        return new RunResource($request->user()->runs);
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
        //
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
        //
    }
}
