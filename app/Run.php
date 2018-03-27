<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\RunDriver;
use App\Waypoint;
use App\Car;
use App\CarType;
use App\User;
use App\Comment;
use App\Artist;
use App\RunSubscription;
use Carbon\Carbon;

/**
 * Run
 * Runs model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Run extends Model
{
    use SoftDeletes;

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'published_at',
        'planned_at',
        'end_planned_at',
        'started_at',
        'ended_at',
        'passengers'
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'published_at',
        'planned_at',
        'end_planned_at',
        'started_at',
        'ended_at'
    ];

    /**
     * MODEL RELATION
     * The runners who drive this run (via the run_driver)
     */
    public function runners()
    {
        return $this->belongsToMany(User::class, 'run_drivers', 'run_id', 'user_id')
                    ->using(RunDriver::class)
                    ->withPivot(["car_type_id","car_id"])
                    ->withTimestamps();
    }

    /**
     * MODEL RELATION
     * The cars assigned to this run (via the run_driver)
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'run_drivers')
                    ->using(RunDriver::class)
                    ->withPivot(["user_id","car_type_id"])
                    ->withTimestamps();
    }

    /**
     * MODEL RELATION
     * The cars types assigned to this run (via the run_driver)
     */
    public function carTypes()
    {
        return $this->belongsToMany(CarType::class, 'run_drivers')
                    ->using(RunDriver::class)
                    ->withPivot(["user_id","car_id"])
                    ->withTimestamps();
    }

    /**
     * MODEL RELATION
     * The group that belong to the user.
     */
    public function waypoints()
    {
        return $this->belongsToMany(Waypoint::class)->withPivot("order");
    }

    /**
     * MODEL RELATION
     * The artist transported in this run
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    /**
     * MODEL RELATION
     * Get all of the run comments
     */
    public function subscriptions()
    {
        return $this->hasMany(RunSubscription::class);
    }

    /**
     * MODEL RELATION
     * Get all of the run comments
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * MODEL SCOPE
     * Return only the finished runs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $needle true || flase
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinished($query, $needle)
    {
        if ($needle == 'true') {
            return $query->where('status', 'finished');
        } elseif ($needle == 'false') {
            return $query->where('status', '!=', 'finished');
        }
        // If the needle not correspond to expected values
        return $query;
    }

    /**
     * MODEL SCOPE
     * Return only the run with the corresponding status
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status The status you want to scope
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * MODEL SCOPE
     * Exclude a type of status from the query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status The status you want to scope
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutStatus($query, $status)
    {
        return $query->where('status', '!=', $status);
    }

    /**
     * MODEL METHOD
     * Determine if the run is ready to go
     *
     * @return bool
     */
    public function ready()
    {
        if ($this->status == 'published' || $this->status == 'finalizing') {
            return true;
        }
        return false;
    }

    /**
     * MODEL METHOD
     * Determine if the run is started (a runner has click on start run)
     *
     * @return bool
     */
    public function started()
    {
        if ($this->status == 'started') {
            return true;
        }
        return false;
    }

    /**
     * MODEL METHOD
     * Starts a run
     *
     * @return bool
     */
    public function start()
    {
        // Set the run start time and status
        $this->status = 'started';
        $this->started_at = Carbon::now();
        $this->save();
    }

    /**
     * MODEL METHOD
     * Ends a run
     *
     * @return bool
     */
    public function stop()
    {
        $this->status = 'finished';
        $this->ended_at = Carbon::now();
        $this->save();
    }
}
