<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;
use App\RunDriver;
use App\Run;
use App\Comment;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;

/**
 * CarType
 * Car types model
 *
 * @author Bastien Nicoud
 * @package App
 */
class CarType extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'nb_place'
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
     * The cars in this type
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'type_id');
    }

    /**
     * MODEL RELATION
     * The run driver who this car type is specified
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The runs who this car type is assigned (vie the run_drivers)
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * Get all of the car type comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
