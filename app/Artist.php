<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Run;
use App\Comment;

/**
 * Artist
 * Artists model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Artist extends Model
{
    use SoftDeletes;

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
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
     * The runs where this artist is asigned
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class);
    }

    /**
     * MODEL RELATION
     * Get all of the artists comments
     * Actually not used, but if you want to comment a given artist ??!
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
