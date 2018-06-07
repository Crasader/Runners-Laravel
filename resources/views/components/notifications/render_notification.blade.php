{{--
  -- Render notification
  -- Render a notification in function of his type
  -- User in notification show route
  --
  -- @author Bastien Nicoud
  --}}

@switch($notification->type)
    @case('App\Notifications\UnHandledExceptionNotification')
        @include('notifications.layouts.UnHandledExceptionNotification', ['notification' => $notification])
        @break

    @default
        <div class="content"><h2>Notification non reconnue</h2></div>
@endswitch
