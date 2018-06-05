<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Schedule;
use App\Comment;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;

/**
 * Group
 * Groups model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Group extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color', 'name', 'active',
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
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * MODEL RELATION
     * The shedules of this group
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * MODEL RELATION
     * Get all of the group type comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
