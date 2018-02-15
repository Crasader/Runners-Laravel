<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

/**
 * Attachment
 * Model to save atachments (images, files...)
 * and is attached to a model via polymorphic relation (have_image...) field.
 *
 * @author Bastien Nicoud
 * @package App
 */
class Attachment extends Model
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
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * MODEL RELATION
     * Get all of the owning image pinnable models.
     */
    public function attachable()
    {
        return $this->morphTo();
    }
}
