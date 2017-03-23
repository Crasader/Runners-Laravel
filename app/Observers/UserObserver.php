<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 23.03.2017
 * Time: 14:06
 */

namespace App\Observers;


use App\Events\RunDeletingEvent;

class CarObserver
{
  public function subscribe($events)
  {

    $events->listen(
      'App\Events\RunDeletingEvent',
      [$this,'runIsDeleting']
    );
    
  }
  public function runIsDeleting(RunDeletingEvent $event)
  {
    $run = $event->run;
    $run->subscriptions->map(function($sub){//FREE ALL THE USERS
      $sub->user->status="free";
    });
  }
}