<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * RunSubscription
 * This model is a trick to interacts with the run dirvers subscription tu a run (users, cars...)
 * Here we fire some events, when you add a user to a run or change a car, you pass via this model
 * when you just read infos about a run, use the RunDriver relations
 *
 * @author Bastien Nicoud
 * @package App
 */
class RunSubscription extends Model
{
    use SoftDeletes;

    /**
     * MODEL PROPERTY
     * The table name who this model is binded
     *
     * @var string
     */
    public $table = 'run_drivers';

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
    ];

    /**
     * MODEL PROPERTY
     * Parent models where the timestamp is updated when this model is updated.
     *
     * @var array
     */
    protected $touches = [
        "run"
      ];

    /**
     * MODEL PROPERTY
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * MODEL RELATION
     * The user who drive this run
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

    /**
     * MODEL METHOD
     * Save subscription parts (car, user)
     * Called by the run crud (when we save or update a new run)
     */
    public function saveDatas($subscriptionDatas)
    {
        if ($user = User::where('name', $subscriptionDatas['user'])->first()) {
            $this->assignUser($user);
        } elseif ($subscriptionDatas['user'] == null) {
            $this->user()->dissociate();
        }
        if ($carType = CarType::where('name', $subscriptionDatas['carType'])->first()) {
            $this->assignCarType($carType);
        } elseif ($subscriptionDatas['carType'] == null) {
            $this->carType()->dissociate();
        }
        if ($car = Car::where('name', $subscriptionDatas['car'])->first()) {
            $this->assignCar($car);
        } elseif ($subscriptionDatas['car'] == null) {
            $this->car()->dissociate();
        }
        $this->save();
    }

    /**
     * MODEL METHOD
     * Assign a run to this subscription
     *
     * @param \App\Run $run
     */
    public function assignRun($run)
    {
        $this->run()->associate($run->id);
        $this->save();
    }

    /**
     * MODEL METHOD
     * Assign an user to this subscription
     *
     * @param \App\User $user
     */
    public function assignUser($user)
    {
        $this->user()->associate($user->id);
        $this->save();
    }

    /**
     * MODEL METHOD
     * Assign a car to this subscription
     * (It assign the cartype automaticaly)
     *
     * @param \App\Car $car
     */
    public function assignCar($car)
    {
        $this->car()->associate($car->id);
        $this->carType()->associate($car->type->id);
        $this->save();
    }

    /**
     * MODEL METHOD
     * Assign a car to this subscription
     * (It assign the cartype automaticaly)
     *
     * @param \App\Car $car
     */
    public function assignCarType($carType)
    {
        $this->carType()->associate($carType->id);
        $this->save();
    }
}
