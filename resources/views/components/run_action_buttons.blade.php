{{--
  -- Run actions button
  -- Display the right button from the status value
  --
  -- @author Bastien Nicoud
  --}}

@switch($status)
    @case('gone')
        <a href="{{ route('runs.stop', ['run' => $id]) }}" class="button is-small is-danger">
            Arréter
        </a>
        @break

    @case('finished')
        <a href="{{ route('runs.destroy', ['run' => $id]) }}" class="button is-small is-black">
            Supprimer
        </a>
        @break

    @case('needs_filling')
        <a href="{{ route('runs.edit', ['run' => $id]) }}" class="button is-small is-info">
            Compléter
        </a>
        @break

    @case('drafting')
        <a href="{{ route('runs.publish', ['run' => $id]) }}" class="button is-small is-info">
            Publier
        </a>
        @break

    @case('error')
        <a href="{{ route('runs.edit', ['run' => $id]) }}" class="button is-small is-info">
            Compléter
        </a>
        @break

    @case('ready')
        <a href="{{ route('runs.start', ['run' => $id]) }}" class="button is-small is-success">
            Démarrer
        </a>
        @break

    @default
        <a href="#" class="button is-small is-success">
            Aucune action
        </a>
@endswitch