<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RunDriver;
use App\CarType;

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
}
