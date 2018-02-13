<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Run;
use App\Comment;

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
}
