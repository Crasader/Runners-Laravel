<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Group;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time', 'end_time'
    ];

    /**
     * The group that belong this schedule
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
