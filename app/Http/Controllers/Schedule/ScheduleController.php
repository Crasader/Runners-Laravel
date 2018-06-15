<?php

namespace App\Http\Controllers\Schedule;

use App\Schedule;
use App\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Group;
use App\Http\Resources\Schedules\CalendarFormatScheduleResource;
use App\Http\Requests\Schedules\StoreSchedule;

/**
 * ScheduleController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Schedule
 */
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $firstday = Schedule::orderBy('start_time')->first();
        // $lastday = Schedule::orderBy('start_time', 'desc')->first();
        // $nbDays = $firstday->start_time->diffInDays($lastday->end_time);
        // dd($nbDays, $firstday, $lastday);
        $schedules = Schedule::with('group')->orderBy('start_time')->get();
        //return view('schedules.index');
        return view('schedules.index')->with(compact('schedules'));
    }

    /**
     * Return all events at json format for the calendar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function events(Request $request)
    {
        $events = Schedule::with('group')->get();
        return CalendarFormatScheduleResource::collection($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('schedules.create')->with(compact('schedule', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Schedules\StoreSchedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchedule $request)
    {
        $schedules = new Schedule([
            'group_id' => $request->group_id,
            'start_time' => Carbon::parse($request->start_time),
            'end_time' => Carbon::parse($request->end_time)
        ]);
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
        return view('schedules.show')->with(compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $groups = Group::all();
        return view('schedules.edit')->with(compact('schedule', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Schedules\StoreSchedule  $schedule
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSchedule $request, Schedule $schedule)
    {
        $schedule->fill([
            'group_id' => $request->group_id,
            'start_time' => Carbon::parse($request->start_time),
            'end_time' => Carbon::parse($request->end_time)
        ]);
        $schedule->save();

        return redirect()
            ->route('schedules.index')
            ->with('success', "L'horaire à bien été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('schedules.index')
            ->with('success', "L'horaire à bien été supprimé");
    }
}
