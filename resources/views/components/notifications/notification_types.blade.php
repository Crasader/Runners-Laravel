{{--
  -- Notifications types
  -- Generates user friendly view according to the notification type (class name)
  --
  -- @author Bastien Nicoud
  --}}

@switch($type)
    @case('App\Notifications\UnHandledExceptionNotification')
        <span class="tag {{ $slot }} is-danger">Erreur d'application non capturée</span>
        @break

    @default
        <span class="tag {{ $slot }} is-light">Notification non reconnue</span>
@endswitch
