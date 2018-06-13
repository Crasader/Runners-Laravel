<?php

namespace App\Listeners;

use App\Log;
use App\Comment;
use App\Attachment;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
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
    /**
     * Create a log record on the database
     *
     * @param Event $event
     * @param string $action
     * @return void
     */
    public function log($model, $action)
    {
        $log = new Log(['action' => $action]);
        $log->user()->associate(Auth::user());
        $log->loggable()->associate($model);
        $log->save();
    }
    /**
     * Handle eloquent creations
     */
    public function onDatabaseCreate($event)
    {
        $this->log($event->model, "created");
        // Create special log for comments
        if ($event->model instanceof Comment) {
            $this->log($event->model->commentable, "commented");
        }
    }

    /**
     * Handle eloquent creations
     */
    public function onDatabaseUpdate($event)
    {
        $this->log($event->model, "updated");
        // Special fog for Qr codes
        if ($event->model instanceof Attachment) {
            if ($event->model->type === 'qrcode') {
                $this->log($event->model->attachable, "qrcode-generated");
            }
        }
    }

    /**
     * Handle eloquent creations
     */
    public function onDatabaseDelete($event)
    {
        $this->log($event->model, "deleted");
    }

    /**
     * Handle eloquent creations
     */
    public function onDatabaseRestore($event)
    {
        $this->log($event->model, "restored");
    }

    /**
     * Create an authentication log in the database
     *
     * @param [type] $user
     * @param [type] $action
     * @return void
     */
    public function logUserAuthentication($user, $action)
    {
        $log = new Log(['action' => $action]);
        $log->user()->associate($user);
        $log->loggable()->associate($user);
        $log->save();
    }

    /**
     * Handle user log-in
     */
    public function onUserLogIn($event)
    {
        $this->logUserAuthentication($event->user, "login");
    }

    /**
     * Handle user log-out
     */
    public function onUserLogOut($event)
    {
        $this->logUserAuthentication($event->user, "logout");
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        // Database events
        $events->listen(LogDatabaseCreateEvent::class, [$this, 'onDatabaseCreate']);
        $events->listen(LogDatabaseUpdateEvent::class, [$this, 'onDatabaseUpdate']);
        $events->listen(LogDatabaseDeleteEvent::class, [$this, 'onDatabaseDelete']);
        $events->listen(LogDatabaseRestoreEvent::class, [$this, 'onDatabaseRestore']);

        // Authentication events
        $events->listen(Login::class, [$this, 'onUserLogIn']);
        $events->listen(Logout::class, [$this, 'onUserLogOut']);
    }
}
