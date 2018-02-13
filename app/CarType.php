<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Car;
use App\RunDriver;

class CarType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * The cars in this type
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    /**
     * The run driver who this car type is specified
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }
}
