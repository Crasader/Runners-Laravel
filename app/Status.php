<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Status
 * Store the statuses possible in the app
 *
 * @author Bastien Nicoud
 * @package App
 */
class Status extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'slug', 'description', 'shows_on_kiela'
    ];

    /**
     * MODEL RELATION
     * the model who have this status
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'statusable');
    }
}
