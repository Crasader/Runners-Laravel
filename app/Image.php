<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

/**
 * Image
 * Model for images, each images belongs to an user (the user who upload it),
 * and is attached to a model via polymorphic relation (have_image...) field.
 * @author Bastien Nicoud
 * @package App
 */
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
        return $this->morphTo(null, 'have_image_type', 'have_image_id');
    }
}
