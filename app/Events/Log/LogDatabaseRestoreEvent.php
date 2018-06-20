<?php

namespace App\Events\Log;

use Illuminate\Queue\SerializesModels;

/**
 * LogDatabaseRestoreEvent
 *
 * @author Bastien Nicoud
 * @package App\Events\Log
 */
class LogDatabaseRestoreEvent
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