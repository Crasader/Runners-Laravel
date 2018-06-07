{{--
  -- Render notification
  -- Render a notification in function of his type
  -- User in notification show route
  --
  -- @author Bastien Nicoud
  --}}

@switch($notification->type)
    @case('App\Notifications\UnHandledExceptionNotification')
        <p><span class="tag {{ $slot }} is-danger">Erreur d'application non capturée</span></p>
        @break

    @default
        <div class="content"><h2>Notification non reconnue</h2></div>
@endswitch
