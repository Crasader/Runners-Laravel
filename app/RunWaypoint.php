<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Run;
use App\Waypoint;

/**
 * RunWaypoint
 * This class represents the pivot table between runs and waypoints.
 * @author Bastien Nicoud
 * @package app
 */
class RunWaypoint extends Pivot
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order'
    ];

    /**
     * MODEL RELATION
     * Link to the run
     */
    public function run()
    {
        return $this->belongsTo(Run::class);
    }

    /**
     * MODEL RELATION
     * Link to the waypoint
     */
    public function waypoint()
    {
        return $this->belongsTo(Waypoint::class);
    }
}
