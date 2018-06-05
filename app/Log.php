<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Log
 *
 * @author Bastien Nicoud
 * @package App
 */
class Log extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action'
    ];

    /**
     * MODEL RELATION
     * Get all of the leggable models
     */
    public function loggable()
    {
        return $this->morphTo();
    }

    /**
     * MODEL RELATION
     * The user wo triggs this event
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
