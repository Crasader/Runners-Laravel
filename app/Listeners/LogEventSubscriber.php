<?php

namespace App\Listeners;

use App\Log;
use Illuminate\Support\Facades\Auth;
use App\Events\Log\LogDatabaseCreateEvent;

class LogEventSubscriber
{
    /**
     * Handle eloquent creations
     */
    public function onDatabaseCreate($event)
    {
        $log = new Log(['action' => "Création"]);
        $log->user()->associate(Auth::user());
        $log->loggable()->associate($event->model);
        $log->save();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(LogDatabaseCreateEvent::class, [$this, 'onDatabaseCreate']);
    }
}
