<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
  protected $fillable = ["name"];
  public function waypoints(){
    return $this->hasMany(Waypoint::class);
  }
}
