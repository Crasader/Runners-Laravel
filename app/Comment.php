<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

/**
 * Comment
 * Comments model
 *
 * @author Bastien Nicoud
 * @package App
 */
class Comment extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];

    /**
     * MODEL RELATION
     * The user who owns this comment
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * MODEL RELATION
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
