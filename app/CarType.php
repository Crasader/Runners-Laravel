<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;
use App\RunDriver;

class CarType extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * MODEL RELATION
     * The cars in this type
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    /**
     * MODEL RELATION
     * The run driver who this car type is specified
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }
}
