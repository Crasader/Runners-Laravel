<?php

namespace App\Extensions;

use App\Status;

/**
 * Statusable
 *
 * This trait allows you to add methods on a model to easily manage status
 * And add the statuses morph relation
 * See example in User model
 *
 * @author Bastien Nicoud
 * @package App\Extensions
 */
trait Statusable
{
    /**
     * MODEL RELATION
     * Get ths status of the user
     */
    public function statuses()
    {
        return $this->morphToMany(Status::class, 'statusable');
    }

    /**
     * MODEL METHOD
     * Return the status of the user
     *
     * @return string
     */
    public function status()
    {
        return $this->statuses()->first();
    }

    /**
     * MODEL METHOD
     * Set the status of the model depending the slug
     *
     * @param null $statusSlug
     * @return string
     */
    public function setStatus($statusSlug = null)
    {
        if ($statusSlug != null) {
            $this->statuses()
                ->sync(
                    Status::where([
                        ['slug', $statusSlug],
                        ['type', get_class($this)]
                    ])
                    ->first()
                    ->id
                );
        }
    }
}
