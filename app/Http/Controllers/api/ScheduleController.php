<?php

namespace App\Http\Controllers\api;

use App\Schedule;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Schedules\ScheduleCollection;
use App\Http\Requests\Schedules\StoreSchedule;
use App\Http\Resources\Schedules\ScheduleResource;

/**
 * ScheduleController
 * Api ressource controller
 *
 * @author Bastien Nicoud
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
        $this->authorize('view', Schedule::class);
        return new ScheduleCollection(Schedule::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchedule $request)
    {
        $this->authorize('create', Schedule::class);
        $schedule = new Schedule($request->all());
        $schedule->group()->associate(Group::find($request->group_id));
        $schedule->save();
        return (new ScheduleResource($schedule))->response()->setStatusCode(201);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        $schedule->update($request->all());
        $schedule->group()->associate(Group::find($request->group_id));
        $schedule->save();
        return new ScheduleResource($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);
        $schedule->delete();
        return response()->json(null, 204);
    }

    /**
     * Return the working ours of the current user
     *
     * @return \Illuminate\Http\Response
     */
    public function workinghours()
    {
        //
    }
}
