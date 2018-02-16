<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Comment;

/**
 * Festival
 * Festivals model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Festival extends Model
{
    use SoftDeletes;

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'starts_on', 'ends_on'
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'starts_on',
        'ends_on'
    ];

    /**
     * MODEL RELATION
     * The users who have participate to this edition of paleo festival
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * MODEL RELATION
     * Comments on this edition of paleo festival
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
