{{--
  -- Log Action
  -- Colorize the action in the logs crud
  --
  -- @author Bastien Nicoud
  --}}

@switch($action)
    @case('created')
        <span class="tag {{ $slot }} is-success">Création</span>
        @break

    @case('updated')
        <span class="tag {{ $slot }} is-info">Mise a jour</span>
        @break

    @case('deleted')
        <span class="tag {{ $slot }} is-danger">Suppression</span>
        @break

    @case('restored')
        <span class="tag {{ $slot }} is-dark">Réstoration</span>
        @break

    @default
        <span class="tag {{ $slot }} is-light">Aucun status</span>
@endswitch