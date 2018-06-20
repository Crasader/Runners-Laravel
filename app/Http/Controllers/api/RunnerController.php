<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\AssociateNewCarToRunSubscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Runners\RunnerResource;
use App\RunSubscription;
use App\Run;
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
     * Add the current authenticated user to the selected subscription
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function associateRunner(Request $request, $id)
    {
        $sub = RunSubscription::findOrFail($id);
        $sub->user()->associate($request->user());
        $sub->save();
        return response()->json(null, 204);
    }

    /**
     * Add the parameter car to the selected subscription
     *
     * @param  \App\Http\Requests\AssociateNewCarToRunSubscription  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function associateCar(AssociateNewCarToRunSubscription $request, $id)
    {
        $sub = RunSubscription::findOrFail($id);
        $car = Car::findOrFail($request->car_id);
        $sub->car()->associate($car);
        $sub->save();
        return response()->json(null, 204);
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
