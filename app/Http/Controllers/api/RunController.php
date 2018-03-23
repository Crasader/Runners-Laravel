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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RunCollection(Run::all());
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
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        return new RunResource($run);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Run $run)
    {
        //
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
}
