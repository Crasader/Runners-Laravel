<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
            return "Lieux de départ";
        } elseif ($this->position() === Run::find($this->pivot->run_id)->waypoints->count()) {
            return "Lieux d'arrivée";
        } else {
            return "Lieux n° {$this->position()}";
        }
    }
}
