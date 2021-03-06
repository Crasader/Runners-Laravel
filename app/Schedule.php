<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;

use App\Group;
use App\User;

/**
 * Schedule
 * Schedules model
 *
 * @author Bastien Nicoud, Nicolas Henry
 * @package App
 */
class Schedule extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time', 'end_time', 'group_id'
    ];

    /**
     * MODEL PROPERTY
     * Remove model timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * MODEL PROPERTY
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time'
    ];

    /**
     * MODEL EVENTS
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created'  => LogDatabaseCreateEvent::class,
        'updated'  => LogDatabaseUpdateEvent::class,
        'deleted'  => LogDatabaseDeleteEvent::class,
        'restored' => LogDatabaseRestoreEvent::class
    ];

    /**
     * MODEL RELATION
     * Gets the logs corresponding to this model
     */
    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    /**
     * MODEL RELATION
     * The group that belong this schedule
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * MODEL RELATION
     * Get all the users they have this shedule (via the group)
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, Group::class);
    }

    /**
     * MODEL SCOPE
     * Get all the schedule between the specified date
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Carbon $start
     * @param Carbon $end
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetween($query, $start, $end)
    {
        return $query->where('start_time', '<', $end)->where('end_time', '>', $start);
    }

    /**
     * MODEL METHOD
     * Converts the length of the event in percent
     * If the events duration is 12h i takes 50% of a journey
     * Used to display boxes in the schedules
     * ->endOfDay()
     * @return number
     */
    public function lengthInPercent()
    {
        return $this->start_time->diffInMinutes($this->end_time) / 1440 * 100;
    }

    /**
     * MODEL METHOD
     * Converts the time from the begining of the tay to the start of the event in percent
     * Used to display a margin in the left of the element
     *
     * @return number
     */
    public function timeFromDawnInPercent()
    {
        return (100/1440) * $this->start_time->diffInMinutes($this->start_time->copy()->startOfDay());
    }
}
