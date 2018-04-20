<?php

namespace App\Http\Controllers\car;

use App\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * CarTypeController
 * Controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\car
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
        $carTypes = CarType::orderBy('name', 'asc')->paginate(20);
        return view('carTypes.index')->with(compact('carTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartypes = new CarType($request->all());
        $cartypes->save();
        return redirect()->route('carTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        return view('carTypes.show')->with(compact('carType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $carType)
    {
        return view('carTypes.edit')->with(compact('carType'));
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
        $cartype->fill($request->all());
        $cartype->save();
        return redirect()->route('carTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarType $carType)
    {
        //
    }
}
