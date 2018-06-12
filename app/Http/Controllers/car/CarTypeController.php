<?php

namespace App\Http\Controllers\car;

use App\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarTypes\StoreCarType;
use App\Http\Resources\cartypes\CarTypeSearchResource;

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
        $this->authorize('create', CarType::class);
        return view('carTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarType $request)
    {
        $this->authorize('create', CarType::class);
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
        $this->authorize('view', CarType::class);
        return view('carTypes.show')->with(compact('carType'));
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
            $results = CarType::whereRaw('LOWER(`name`) LIKE ? ', [trim(strtolower($request->needle)).'%'])->get();
            return CarTypeSearchResource::collection($results);
        } else {
            return response()->json([], 200);
        }
        return response()->json([], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $carType)
    {
        $this->authorize('update', CarType::class);
        return view('carTypes.edit')->with(compact('carType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarType  $request
     * @param  \App\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCarType $request, CarType $carType)
    {
        $this->authorize('update', CarType::class);
        $carType->fill($request->all());
        $carType->save();
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
        $this->authorize('delete', CarType::class);
        $carType->delete();
        return redirect()->route('carTypes.index');
    }
}
