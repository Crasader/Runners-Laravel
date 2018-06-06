{{--
  -- Status tag
  -- Display the right tag from the status value
  --
  -- @author Bastien Nicoud
  --}}

@switch($status)
    @case('gone')
        <a href="{{ $slot }}" class="button is-small is-danger">
            Arréter
        </a>
        @break

    @case('finished')
        <a href="{{ $slot }}" class="button is-small is-black">
            Supprimer
        </a>
        @break

    @case('needs_filling')
        <a href="{{ $slot }}" class="button is-small is-info">
            Compléter
        </a>
        @break

    @case('drafting')
        <a href="{{ $slot }}" class="button is-small is-info">
            Compléter
        </a>
        @break

    @case('error')
        <a href="{{ $slot }}" class="button is-small is-info">
            Compléter
        </a>
        @break

    @case('ready')
        <a href="{{ $slot }}" class="button is-small is-success">
            Démarrer
        </a>
        @break

    @default
        <a href="{{ $slot }}" class="button is-small is-success">
            Aucun status
        </a>
@endswitch