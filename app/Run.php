<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RunDriver;
use App\Waypoint;

class Run extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'published_at', 'planned_at', 'end_planned_at', 'started_at', 'ended_at', 'passengers'
    ];

    /**
     * MODEL RELATION
     * The run who this run driver is assigned
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The group that belong to the user.
     */
    public function waypoints()
    {
        return $this->belongsToMany(Waypoint::class);
    }
}
