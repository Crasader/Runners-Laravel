<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Run;

class Waypoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The group that belong to the user.
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class);
    }
}
