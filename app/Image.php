<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Image extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'path'
    ];

    /**
     * MODEL RELATION
     * The user who owns this image
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * MODEL RELATION
     * Get all of the owning image pinnable models.
     */
    public function haveImage()
    {
        return $this->morphTo();
    }
}
