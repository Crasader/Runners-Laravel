<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Runners\RunnerResource;
use App\RunSubscription;
use App\Run;
use App\Http\Requests\AssignRunnerToRun;
use App\Car;

class RunnerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new RunnerResource(RunSubscription::find($id));
    }

    /**
     * Add the current authenticated user to the first available subscription of the run
     *
     * @param  \App\Http\Requests\AssignRunnerToRun  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function store(AssignRunnerToRun $request, Run $run)
    {
        if ($sub = $run->takeSubscription($request->user())) {
            return new RunnerResource($sub);
        } else {
            return response()->json(null, 204);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sub = RunSubscription::find($id);
        if ($request->input('car')) {
            // Assign a car to the run subscription
            $sub->assignCar(Car::find($request->input('car')));
        } elseif ($request->input('user')) {
            // Change the assigned user to this subscription
            $sub->assignUser(User::find($request->input('user')));
        }
        return new RunnerResource($sub);
    }
}
