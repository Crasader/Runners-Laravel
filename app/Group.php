<?php
/**
 * User: Eric.BOUSBAA
 */
namespace App;

use App\Helpers\Status;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        "active",
        "color"
    ];
    protected $casts = [
        "active"=>"boolean"
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function scopeActifUser($query){
      return $query->whereHas("users",function($q){
        $q->where("status",Status::getUserStatus("actif"));
      });
    }
}
