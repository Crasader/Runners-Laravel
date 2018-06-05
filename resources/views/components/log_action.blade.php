{{--
  -- Log Action
  -- Colorize the action in the logs crud
  --
  -- @author Bastien Nicoud
  --}}

@switch($action)
    @case('created')
        <span class="tag {{ $slot }} is-success">Crée</span>
        @break

    @case('updated')
        <span class="tag {{ $slot }} is-info">Mis a jour</span>
        @break

    @case('deleted')
        <span class="tag {{ $slot }} is-danger">Supprimé</span>
        @break

    @case('restored')
        <span class="tag {{ $slot }} is-dark">Réstoré</span>
        @break

    @default
        <span class="tag {{ $slot }} is-light">Aucun status</span>
@endswitch