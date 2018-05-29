<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Kiela
 * Kielas model
 *
 * @author Nicolas Henry
 * @package App
 */
class Kiela extends Model
{
    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time',
        'end_time'
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
