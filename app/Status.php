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

    /**
     * MODEL SCOPE
     * Limit the request to a specific type of statuses
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * MODEL SCOPE
     * Limit the request to the users status
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserStatuses($query)
    {
        return $query->type('App\User');
    }
}
