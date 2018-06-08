<?php

namespace App\Events\Log;

use App\Order;
use Illuminate\Queue\SerializesModels;

/**
 * LogDatabaseCreateEvent
 *
 * @author Bastien Nicoud
 * @package App\Events\Log
 */
class LogDatabaseCreateEvent
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