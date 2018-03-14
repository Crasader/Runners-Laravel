<?php

namespace App\Http\Controllers\api;

use App\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\cartypes\CarTypeCollection;
use App\Http\Resources\cartypes\CarTypeResource;
use App\Http\Requests\StoreCarType;

/**
 * UserController
 * Api ressource controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\api
 */
class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CarTypeCollection(CarType::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarType $request)
    {
        $carTypes = new CarType($request->all());
        $carTypes->save();
        return (new CarTypeResource($carTypes))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        return new CarTypeResource($carType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarType $carType)
    {
        $carType->fill($request->all());
        $carType->save();
        return new CarTypeResource($carType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarType $carType)
    {
        $carType->delete();
        return response()->json(null, 204);
    }
}
