<?php

namespace App\Http\Controllers\car;

use App\Car;
use App\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cars\StoreCar;
use App\Http\Resources\cars\CarSearchResource;
use App\Http\Requests\Cars\UpdateCar;

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
        $cars = Car::orderBy('name', 'asc')->paginate(20);
        return view('cars.index')->with(compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Car::class);
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Cars\StoreCar  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCar $request)
    {
        $this->authorize('create', Car::class);
        $cars = new Car($request->all());
        $cars->type()->associate(CarType::find($request->type_id));
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
        $this->authorize('view', Car::class);
        return view('cars.show')->with(compact('car'));
    }

    /**
     * Search in the model, return json
     * This method is designed to be used with the search fields (see the search field component)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->needle) {
            // Case insensitive search
            $results = Car::whereRaw('LOWER(`name`) LIKE ? ', [trim(strtolower($request->needle)).'%'])
                ->whereNotIn('status', ['problem'])
                ->get();
            return CarSearchResource::collection($results);
        } else {
            return response()->json([], 200);
        }
        return response()->json([], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        return view('cars.edit')->with(compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Cars\StoreCar  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCar $request, Car $car)
    {
        $this->authorize('update', $car);
        $car->fill($request->all());
        $car->type()->associate(CarType::find($request->type_id));
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
        $this->authorize('delete', $car);
        if ($car->runDrivers()->exists()) {
            return redirect()
                ->back()
                ->with('error', "Ce véhicule ne peux être supprimé car il est en cours d'utilisation.");
        }
        $car->delete();
        return redirect()->route('cars.index');
    }
}
