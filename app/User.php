<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;
use App\Group;
use App\Comment;
use App\RunDriver;
use App\Schedule;
use App\Run;
use App\Car;
use App\Image;

/**
 * User
 * User model
 * @author Bastien Nicoud
 * @package app
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * MODEL RELATION
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * MODEL RELATION
     * The group that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    /**
     * MODEL RELATION
     * The comments that belong to the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * MODEL RELATION
     * The images that belong to the user.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * MODEL RELATION
     * The run_driver this user drive
     */
    public function runDriver()
    {
        return $this->hasMany(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The runs who this user is mandated
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The cars who this user drives (vie run_driver)
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * Get all the schedules of this user (via the group)
     */
    public function schedules()
    {
        return $this->hasManyThrough(Schedule::class, Group::class);
    }

    /**
     * MODEL RELATION
     * Get all of the comments on this profile (not the comments who belongs to this user)
     */
    public function commented()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * MODEL RELATION
     * The images pinned for this user (profile and conduct card)
     */
    public function userImage()
    {
        return $this->morphMany(Image::class, 'have_image');
    }
}
