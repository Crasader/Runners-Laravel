<?php

namespace App\Http\Controllers\Schedule;

use App\Schedule;
use App\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Group;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $festival = Festival::whereYear('starts_on', date('Y'))->get()->first();
        $schedules = Schedule::orderBy('start_time', 'desc')->get();
        $groups = Group::orderBy('name','asc')->get();
        //New data to generate header of table with date
        $beginFest = (new Carbon)->parse($festival->starts_on);
        $beginFest = $beginFest->subDay();
        //New data to generate footer of table with date
        $beginFest2 = (new Carbon)->parse($festival->starts_on);
        $beginFest2 = $beginFest2->subDay();
        //Count the number of day for the festival
        $range = $festival->starts_on->diffInDays($festival->ends_on)+1;
        //New hour for table
        $someTime = Carbon::createFromFormat('H:i', '00:00');

        return view('schedules.index')->with(compact(['festival', 'schedules', 'beginFest', 'beginFest2', 'range', 'groups', 'someTime']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedules = new Schedule($request->all());
        $schedules->save();
        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
