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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    /**
     * The user who drive this run_driver
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The run who this run driver is assigned
     */
    public function run()
    {
        return $this->belongsTo(Run::class);
    }

    /**
     * The type of car assigned to this driver
     */
    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    /**
     * The car assigned to this driver
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
