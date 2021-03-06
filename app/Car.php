<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RunDriver;
use App\CarType;
use App\Run;
use App\User;
use App\Comment;
use App\Image;
use App\RunSubscription;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;

/**
 * Car
 * Retrive the cars datas
 *
 * @author Bastien Nicoud
 * @package App
 */
class Car extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'plate_number',
        'brand',
        'model',
        'color',
        'nb_places',
        'status'
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
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
     * The run drivers who this car is assigned
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The subscriptions for this run
     */
    public function subscriptions()
    {
        return $this->hasMany(RunSubscription::class);
    }

    /**
     * MODEL RELATION
     * The type of this car
     */
    public function type()
    {
        return $this->belongsTo(CarType::class, 'type_id');
    }

    /**
     * MODEL RELATION
     * The runs who this car is assigned (vie the run_drivers)
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class, 'run_drivers')->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The runners who drive this car (via the run_driver)
     */
    public function runners()
    {
        return $this->belongsToMany(User::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * Get all of the car's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * MODEL RELATION
     * The images pinned for this car
     */
    public function carImage()
    {
        return $this->morphMany(Image::class, 'have_image');
    }
}
