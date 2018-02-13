<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Group;
use App\User;

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
     * Remove model timestamps
     *
     * @var bool
     */
    public $timestamps = false;

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
    public function schedules()
    {
        return $this->hasManyThrough(User::class, Group::class);
    }
}
