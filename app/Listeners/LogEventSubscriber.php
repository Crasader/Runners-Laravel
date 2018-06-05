<?php

namespace App\Listeners;

class LogEventSubscriber
{
    /**
     * Handle eloquent saves
     */
    public function onModelSave($event)
    {
        dd('tutu');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'eloquent.saved',
            [$this, 'onModelSave']
        );
    }
}
