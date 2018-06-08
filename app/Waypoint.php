<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;

use App\Run;
use App\Comment;

/**
 * Waypoint
 * Waypoints model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Waypoint extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
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
     * The group that belong to the user.
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class);
    }

    /**
     * MODEL RELATION
     * Get all of the waypoints comments
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * MODEL METHOD
     * Return the position of this waypoit
     * Use it only when the waypoint is retrived via eloquent relation, otherwise the pivot is not assigned
     *
     * @return int
     */
    public function position()
    {
        return $this->pivot->order;
    }

    /**
     * MODEL METHOD
     * Return a formated string with the position of the waypoint like : "Premier lieux" or "Lieux n° 3"
     *
     * @return string
     */
    public function positionToString()
    {
        if ($this->position() === 1) {
            return "Lieu de départ";
        } elseif ($this->position() === Run::find($this->pivot->run_id)->waypoints->count()) {
            return "Lieu d'arrivée";
        } else {
            return "Lieu n° {$this->position()}";
        }
    }
}
