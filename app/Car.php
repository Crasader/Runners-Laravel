<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RunDriver;
use App\CarType;
use App\Run;
use App\User;
use App\Comment;
use App\Image;

/**
 * Car
 * Retrive the cars datas
 * @author Bastien Nicoud
 * @package App
 */
class Car extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'plate_number', 'brand', 'model', 'color', 'nb_places', 'status'
    ];

    /**
     * MODEL RELATION
     * The run drivers who this car is assigned
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The type of this car
     */
    public function type()
    {
        return $this->belongsTo(CarType::class);
    }

    /**
     * MODEL RELATION
     * The runs who this car is assigned (vie the run_drivers)
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The runners who drive this car (via the run_driver)
     */
    public function runners()
    {
        return $this->belongsToMany(User::class)->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * Get all of the car's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * MODEL RELATION
     * The images pinned for this car
     */
    public function userImage()
    {
        return $this->morphMany(Image::class, 'have_image');
    }
}
