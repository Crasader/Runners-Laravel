<?php

namespace App\Http\Controllers\api;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\cars\CarCollection;
use App\Http\Resources\cars\CarResource;
use App\CarType;
use App\Http\Requests\Cars\StoreCar;

/**
 * CarController
 * Api ressource controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\api
 */
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CarCollection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Cars\StoreCar  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCar $request)
    {
        $car = new Car($request->all());
        $car->type()->associate(CarType::find($request->type_id));
        $car->save();
        return (new CarResource($car))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCar $request, Car $car)
    {
        $car->fill($request->all());
        $car->type()->associate(CarType::find($request->type_id));
        $car->save();
        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(null, 204);
    }
}
