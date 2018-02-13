<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Run;
use App\CarType;
use App\Car;

class RunDriver extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    /**
     * MODEL RELATION
     * The user who drive this run_driver
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * MODEL RELATION
     * The run who this run driver is assigned
     */
    public function run()
    {
        return $this->belongsTo(Run::class);
    }

    /**
     * MODEL RELATION
     * The type of car assigned to this driver
     */
    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    /**
     * MODEL RELATION
     * The car assigned to this driver
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
