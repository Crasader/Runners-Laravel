<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Schedule;

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
     * MODEL RELATION
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * MODEL RELATION
     * The shedules of this group
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
