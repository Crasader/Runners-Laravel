<?php

namespace App;

use App\Car;
use App\Extensions\Statusable;
use App\User;
use App\Artist;
use App\Comment;
use App\CarType;
use App\Waypoint;
use App\RunDriver;
use Carbon\Carbon;
use App\RunSubscription;
use Illuminate\Support\Collection;
use App\Extensions\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

/**
 * Run
 * Runs model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Run extends Model
{
    use SoftDeletes, Filterable, Statusable;

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
     * MODEL EVENTS
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created'  => LogDatabaseCreateEvent::class,
        'updated'  => LogDatabaseUpdateEvent::class,
        'deleted'  => LogDatabaseDeleteEvent::class,
        'restored' => LogDatabaseRestoreEvent::class
    ];


    /**
     * MODEL RELATION
     * Gets the logs corresponding to this model
     */
    public function status(){
        return $this->morphToMany('App\Status', 'statusable');
    }

    /**
     * MODEL RELATION
     * Gets the logs corresponding to this model
     */
    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

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
     * Get all of the run subscription (run_driver) table
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
     * Save run datas
     *
     * @param array $runDatas the datas for the run creation
     * @return void
     */
    public function saveDatas($runDatas)
    {
        // Fill the run datas (we font use $this->fill because the date format not work)
        $this->saveArtist($runDatas['artist']);
        $this->infos = $runDatas['infos'];
        $this->passengers = $runDatas['passengers'];
        $this->savePlannedDates($runDatas['planned_at']);
        $this->save();
        $this->saveWaypoints(collect($runDatas['waypoints']));
        if (isset($runDatas['subscriptions'])) {
            $this->saveSubscriptions(collect($runDatas['subscriptions']));
        }
        $this->save();
        $this->updateStatus();
    }

    /**
     * MODEL METHOD
     * Save the subscription to this run
     *
     * @param \Illuminate\Support\Collection $subscriptions
     * @return void
     */
    public function saveSubscriptions($subscriptions)
    {
        $subscriptions->each(function ($subscription, $key) {
            // Create the subscription if not exist
            $sub = RunSubscription::find($key);
            $sub->saveDatas($subscription);
        });
    }

    /**
     * MODEL METHOD
     * Save the waypoints for this run with the right order
     *
     * @param \Illuminate\Support\Collection $waypoints
     * @return void
     */
    public function saveWaypoints($waypoints)
    {
        // Initialize an index to save the waypoints order
        $waypoints->each(function ($name, $order) {
            // If the waypoint form contains data
            if (!empty($name)) {
                // Detach the waypoint of the run
                $this->waypoints()->wherePivot('order', $order)->detach();
                // If a waypoint with this name exists
                if ($way = Waypoint::where('name', $name)->first()) {
                    $this->waypoints()->attach($way->id, ['order' => $order]);
                } else {
                    // If no waypoint with this name, create a new one
                    $newWay = Waypoint::create(['name' => $name]);
                    $this->waypoints()->attach($newWay->id, ['order' => $order]);
                }
            }
        });
    }

    /**
     * MODEL METHOD
     * Save the name (get it from the artist if not set)
     *
     * @param string $name
     * @return void
     */
    public function saveName()
    {
        $this->name = $this->artists->first()->name;
        $this->save();
    }

    /**
     * MODEL METHOD
     * Save the artist if exists
     * Create new artist if not exists in the db
     *
     * @param string|null $artistName
     * @return void
     */
    public function saveArtist($artistName)
    {
        if (!empty($artistName)) {
            // If the artist exists
            if ($artist = Artist::where('name', $artistName)->first()) {
                // Attach it
                $this->artists()->sync([$artist->id]);
                $this->name = $artist->name;
                $this->save();
            } else {
                // If not, create it
                $newArtist = Artist::create(['name' => $artistName]);
                $this->artists()->sync([$newArtist->id]);
                $this->name = $newArtist->name;
                $this->save();
            }
        }
    }

    /**
     * MODEL METHOD
     * Save the planned dates of a run (if specified)
     *
     * @param string|null $planned_at
     * @param string|null $end_planned_at
     * @return void
     */
    public function savePlannedDates($planned_at)
    {
        // Parse the dates with carbon pare because the HTML5 datetime-local input is usuported
        // by the default createFromFormat method user by eloquent to parse the dates
        if (!empty($planned_at)) {
            $this->planned_at = Carbon::parse($planned_at);
        }
    }

    /**
     * MODEL METHOD
     * Add new empty subscription to a run
     *
     * @return bool
     */
    public function newSubscription()
    {
        $sub = new RunSubscription();
        $this->subscriptions()->save($sub);
    }

    /**
     * MODEL METHOD
     * Remove subscription for this run
     *
     * @return bool
     */
    public function removeSubscription($id)
    {
        $sub = RunSubscription::findOrFail($id)->delete();
    }

    /**
     * MODEL METHOD
     * Add new empty waypoint for the run
     *
     * @return bool
     */
    public function newWaypoint($order)
    {
        // Create an empty waypoint
        $this->waypoints()->save(Waypoint::find(1), ['order' => 0]);
        // Map the waypoints and order it (adding the new waypoint after the clicked field (see edition page))
        $ids = $this->waypoints->map(function ($waypoint) use ($order) {
            if ($waypoint->pivot->order == 0) {
                return [$waypoint->id => ['order' => ($order + 1)]];
            } elseif ($waypoint->pivot->order > intval($order)) {
                return [$waypoint->id => ['order' => ($waypoint->pivot->order + 1)]];
            } elseif ($waypoint->pivot->order <= intval($order)) {
                return [$waypoint->id => ['order' => $waypoint->pivot->order]];
            }
        });
        // Detatch all waypoints
        $this->waypoints()->detach();
        // Reatach the waypoints in correct order
        $ids->each(function ($id) {
            $this->waypoints()->attach($id);
        });
    }

    /**
     * MODEL METHOD
     * Remove a waypoint for the run
     *
     * @return bool
     */
    public function removeWaypoint($order)
    {
        // Map the waypoints and order it (adding the new waypoint after the clicked field (see edition page))
        $ids = $this->waypoints->map(function ($waypoint) use ($order) {
            if ($waypoint->pivot->order < $order) {
                return [$waypoint->id => ['order' => $waypoint->pivot->order]];
            } elseif ($waypoint->pivot->order > $order) {
                return [$waypoint->id => ['order' => ($waypoint->pivot->order - 1)]];
            }
        });
        // Filter to remove unused waypoints
        $ids = $ids->filter(function ($el) {
            return $el != null;
        });
        // Detatch all waypoints
        $this->waypoints()->detach();
        // Reatach the waypoints in correct order
        $ids->each(function ($id) {
            $this->waypoints()->attach($id);
        });
    }

    /**
     * MODEL METHOD
     * Determine if the run is ready to go
     *
     * @return bool
     */
    public function ready()
    {
        if ($this->status == 'ready') {
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
        if ($this->status == 'gone' || $this->status == 'started') {
            return true;
        }
        return false;
    }

    /**
     * MODEL METHOD
     * Publish the run
     *
     * @return bool
     */
    public function publish()
    {
        // Check if the run is complete (needs 1 runner, passengers, name, date, 2 waypoints)
        if ($this->needsFilling()) {
            $this->status = 'needs_filling';
        } elseif ($this->problem()) {
            $this->status = 'error';
        } else {
            $this->status = 'ready';
        }
        $this->published_at = now();
        $this->save();
    }

    /**
     * MODEL METHOD
     * Check if the run needs filling
     *
     * @return bool
     */
    public function needsFilling()
    {
        $needsFilling = false;
        $needsFilling |= $this->artists()->first() ? false : true;
        $needsFilling |= $this->passengers > 0 ? false : true;
        $needsFilling |= $this->planned_at ? false : true;
        if ($this->subscriptions()->exists()) {
            $this->subscriptions()->each(function ($subscription) use (&$needsFilling) {
                $needsFilling |= $subscription->user()->exists() ? false : true;
                $needsFilling |= $subscription->car()->exists() ? false : true;
            });
        } else {
            $needsFilling |= true;
        }
        $needsFilling |= ($this->waypoints()->count() > 1) ? false : true;
        return $needsFilling;
    }

    /**
     * MODEL METHOD
     * Deremine if the run is in problem
     * (the start time of the run is after now)
     *
     * @return bool
     */
    public function problem()
    {
        return now()->greaterThan($this->planned_at);
    }

    /**
     * MODEL METHOD
     * Check the contents of the run a sets the status
     *
     * @return void
     */
    public function updateStatus()
    {

        if ($this->status_id === Status::runsStatuses()->slug('drafting')->first()->id || $this->status_id === Status::runsStatuses()->slug('gone')->first()->id || $this->status_id === Status::runsStatuses()->slug('finished')->first()->id) {
            $this->save();
        } else {
            if ($this->needsFilling()) {
                $this->status_id = Status::runsStatuses()->slug('needs_filling')->first()->id;
            } elseif ($this->problem()) {
                $this->status_id = Status::runsStatuses()->slug('error')->first()->id;
            } else {
                $this->status_id = Status::runsStatuses()->slug('ready')->first()->id;
            }
            $this->save();
        }
    }

    /**
     * MODEL METHOD
     * Starts a run
     *
     * @return void
     */
    public function start()
    {
        // Set the run start time and status
        $this->status = 'gone';
        $this->started_at = now();
        // Temporary sets the status
        $this->cars->each(function ($item, $key) {
            $item->status = "taken";
            $item->save();
        });
        $this->runners->each(function ($item, $key) {
            $item->setStatus("taken");
            $item->save();
        });
        $this->save();
    }

    /**
     * MODEL METHOD
     * Ends a run
     *
     * @return void
     */
    public function stop()
    {
        $this->status = 'finished';
        $this->ended_at = now();
        // Temporary sets the status
        $this->cars->each(function ($item, $key) {
            $item->status = "free";
            $item->save();
        });
        $this->runners->each(function ($item, $key) {
            $item->setStatus("free");
            $item->save();
        });
        $this->save();
    }

    /**
     * MODEL METHOD
     * Starts a run
     *
     * @return void
     */
    public function forceSart()
    {
        // Set the run start time and status
        $this->status = 'gone';
        $this->started_at = now();
        // Temporary sets the status
        $this->cars->each(function ($item, $key) {
            $item->status = "taken";
            $item->save();
        });
        $this->runners->each(function ($item, $key) {
            $item->setStatus("taken");
            $item->save();
        });
        $this->save();
    }

    /**
     * MODEL METHOD
     * Ends a run
     *
     * @return void
     */
    public function forceStop()
    {
        $this->status = 'finished';
        $this->ended_at = now();
        // Temporary sets the status
        $this->cars->each(function ($item, $key) {
            $item->status = "free";
            $item->save();
        });
        $this->runners->each(function ($item, $key) {
            $item->setStatus("free");
            $item->save();
        });
        $this->save();
    }
}
