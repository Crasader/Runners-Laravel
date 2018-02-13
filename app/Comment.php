<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
