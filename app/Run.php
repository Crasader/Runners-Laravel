<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RunDriver;
use App\Waypoint;
use App\Car;
use App\CarType;
use App\User;

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
     * The runners who drive this run (via the run_driver)
     */
    public function runners()
    {
        return $this->belongsToMany(User::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The cars assigned to this run (via the run_driver)
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The cars types assigned to this run (via the run_driver)
     */
    public function carTypes()
    {
        return $this->belongsToMany(CarType::class)->using(RunDriver::class);
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
