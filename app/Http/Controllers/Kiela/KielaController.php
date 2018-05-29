<?php

namespace App\Http\Controllers\Kiela;

use App\Car;
use App\User;
use App\Kiela;
use App\Festival;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

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
        //Set now time to show the hour
        $now = new Carbon();
        //Select all cars and show by current status
        $cars = Car::orderBy('status', 'asc')->get();
        //Select all users and show by current status
        $users = User::orderBy('status', 'asc')->get();
        //Get current festival
        $festival = Festival::whereYear('starts_on', date('Y'))->get()->first();
        //Query to get user add on Kiela by button
        $presentKiela = Kiela::orderBy('user_id', 'asc')->with('user')->where('start_time', '<=', $now)->where('end_time', '>=', $now)->get();
        //Query to get groups here now
        $present = Schedule::orderBy('group_id', 'asc')->with(['group', 'group.users'])->where('start_time', '<=', $now)->where('end_time', '>=', $now)->get();

        return view('kielas.index')->with(compact('now', 'cars', 'users', 'festival', 'presentKiela', 'present'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Set now time to show the hour
        $now = new Carbon();

        return view('kielas.create')->with(compact('now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Get request
        $kiela = new Kiela($request->all());

        //Associate user to kiela
        $kiela->user()->associate(User::find($request->user_id));
        $kiela->save();
        
        return redirect()->route('kiela.index');
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
