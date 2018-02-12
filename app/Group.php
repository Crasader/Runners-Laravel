<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Schedule;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color', 'name', 'active',
    ];

    /**
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The shedules of this group
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
