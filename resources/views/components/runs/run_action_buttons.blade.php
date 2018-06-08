{{--
  -- Run actions button
  -- Display the right button from the status value
  --
  -- @author Bastien Nicoud
  --}}

@switch($status)
    @case('gone')
        <form
            id="stop-run-form-{{ $id }}"
            action="{{ route('runs.stop', ['run' => $id]) }}" method="POST"
            style="display: none;">
            @csrf
            @method('PATCH')
        </form>
        <a href="#" onclick="event.preventDefault();
            event.stopPropagation();
            document.getElementById('stop-run-form-{{ $id }}').submit();"
            class="button {{ $slot }} is-danger">
            Arréter
        </a>
        @break

    @case('finished')
        <form
            id="delete-run-form-{{ $id }}"
            action="{{ route('runs.destroy', ['run' => $id]) }}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        <a href="#" onclick="event.preventDefault();
            event.stopPropagation();
            document.getElementById('delete-run-form-{{ $id }}').submit();"
            class="button {{ $slot }} is-danger">
            Supprimer
        </a>
        @break

    @case('needs_filling')
        <form
            id="force-start-run-form-{{ $id }}"
            action="{{ route('runs.force-start', ['run' => $id]) }}" method="POST"
            style="display: none;">
            @csrf
            @method('PATCH')
        </form>
        <a href="#" onclick="event.preventDefault();
            event.stopPropagation();
            document.getElementById('force-start-run-form-{{ $id }}').submit();"
            class="button {{ $slot }} is-warning">
            Force start
        </a>
        @break

    @case('drafting')
        <form
            id="publish-run-form-{{ $id }}"
            action="{{ route('runs.publish', ['run' => $id]) }}" method="POST"
            style="display: none;">
            @csrf
            @method('PATCH')
        </form>
        <a href="#" onclick="event.preventDefault();
            event.stopPropagation();
            document.getElementById('publish-run-form-{{ $id }}').submit();"
            class="button {{ $slot }} is-info">
            Publier
        </a>
        @break

    @case('error')
        <a href="{{ route('runs.edit', ['run' => $id]) }}" class="button {{ $slot }} is-info">
            Compléter
        </a>
        @break

    @case('ready')
        <form
            id="start-run-form-{{ $id }}"
            action="{{ route('runs.start', ['run' => $id]) }}" method="POST"
            style="display: none;">
            @csrf
            @method('PATCH')
        </form>
        <a href="#" onclick="event.preventDefault();
            event.stopPropagation();
            document.getElementById('start-run-form-{{ $id }}').submit();"
            class="button {{ $slot }} is-success">
            Démarrer
        </a>
        @break

    @default
        <a href="#" class="button {{ $slot }} is-black">
            Aucune action
        </a>
@endswitch