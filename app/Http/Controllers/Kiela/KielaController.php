<?php

namespace App\Http\Controllers\Kiela;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Festival;
use Illuminate\Support\Carbon;
use App\Car;
use App\Group;

/**
 * KielaController
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\Kiela
 */
class KielaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $festival = Festival::whereYear('starts_on', date('Y'))->get()->first();
        $now = new Carbon();   
        $users = User::orderBy('status', 'asc')->get();
        $cars = Car::orderBy('status', 'asc')->get();
        $groups = Group::orderBy('id', 'asc')->get();
        
        return view('kielas.index')->with(compact('users', 'cars', 'groups', 'festival', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
