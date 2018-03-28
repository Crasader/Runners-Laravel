<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        'start_time', 'end_time'
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
}
