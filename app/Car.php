<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RunDriver;
use App\CarType;

class Car extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'plate_number', 'brand', 'model', 'color', 'nb_places', 'status'
    ];

    /**
     * The run drivers who this car is assigned
     */
    public function runDrivers()
    {
        return $this->hasMany(RunDriver::class);
    }

    /**
     * The type of this car
     */
    public function type()
    {
        return $this->belongsTo(CarType::class);
    }
}
