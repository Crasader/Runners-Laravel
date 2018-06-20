<?php

namespace App\Events\Log;

use Illuminate\Queue\SerializesModels;

/**
 * LogDatabaseDeleteEvent
 *
 * @author Bastien Nicoud
 * @package App\Events\Log
 */
class LogDatabaseDeleteEvent
{
    use SerializesModels;

    public $model;

    /**
     * Create a new event instance.
     *
     * @param  Model  $model
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
}