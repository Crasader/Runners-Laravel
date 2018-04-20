<?php

namespace App\Http\Controllers\car;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCar;

/**
 * CarController
 * Controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\car
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
        $cars = Car::orderBy('model', 'asc')->paginate(20);
        return view('cars.index')->with(compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCar  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCar $request)
    {
        $cars = new Car($request->all());
        $cars->save();
        return redirect()->route('cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('cars.show')->with(compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('cars.edit')->with(compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCar  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCar $request, Car $car)
    {
        $car->fill($request->all());
        $car->save();
        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if ($car->runDrivers()->exists()) {
            return redirect()
                ->back()
                ->with('error', "Ce véhicule ne peux être supprimé car il est en cours d'utilisation.");
        }
        $car->delete();
        return redirect()->route('cars.index');
    }
}
