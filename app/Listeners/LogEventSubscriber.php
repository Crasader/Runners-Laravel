<?php

namespace App\Listeners;

use App\Log;
use Illuminate\Support\Facades\Auth;
use App\Events\Log\LogDatabaseCreateEvent;
use App\Events\Log\LogDatabaseUpdateEvent;
use App\Events\Log\LogDatabaseDeleteEvent;
use App\Events\Log\LogDatabaseRestoreEvent;

/**
 * LogEventSubscriber
 * Subscriber for all eloquent events thats logged in the logs table
 *
 * @author Bastien Nicoud
 * @package App\Listeners
 */
class LogEventSubscriber
{
    public function log($event, $action)
    {
        $log = new Log(['action' => $action]);
        $log->user()->associate(Auth::user());
        $log->loggable()->associate($event->model);
        $log->save();
    }
    /**
     * Handle eloquent creations
     */
    public function onDatabaseCreate($event)
    {
        $this->log($event, "created");
    }

    /**
     * Handle eloquent creations
     */
    public function onDatabaseUpdate($event)
    {
        $this->log($event, "updated");
    }

    /**
     * Handle eloquent creations
     */
    public function onDatabaseDelete($event)
    {
        $this->log($event, "deleted");
    }

    /**
     * Handle eloquent creations
     */
    public function onDatabaseRestore($event)
    {
        $this->log($event, "restored");
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(LogDatabaseCreateEvent::class, [$this, 'onDatabaseCreate']);
        $events->listen(LogDatabaseUpdateEvent::class, [$this, 'onDatabaseUpdate']);
        $events->listen(LogDatabaseDeleteEvent::class, [$this, 'onDatabaseDelete']);
        $events->listen(LogDatabaseRestoreEvent::class, [$this, 'onDatabaseRestore']);
    }
}
