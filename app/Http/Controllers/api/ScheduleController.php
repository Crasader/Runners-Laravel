<?php

namespace App\Http\Controllers\api;

use App\Schedule;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Schedules\ScheduleCollection;
use App\Http\Requests\Schedules\StoreSchedule;
use App\Http\Resources\Schedules\ScheduleResource;
use Illuminate\Support\Carbon;

/**
 * ScheduleController
 * Api ressource controller
 *
 * @author Bastien Nicoud, Henry Nicolas
 * @package App\Http\Controllers\api
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
        return new ScheduleCollection(Schedule::all());
    }

    /**
     * Display the schedule fot the connected user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function workingHours(Request $request)
    {
        return new ScheduleCollection($request->user()->groups->first()->schedules);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        $this->authorize('view', $schedule);
        return new ScheduleResource($schedule);
    }
}
