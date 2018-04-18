{{--
  -- Status tag
  -- Display the right tag from the status value
  --
  -- @author Bastien Nicoud
  --}}

@switch($status)
    @case('active')
        <span class="tag is-success">Disponible</span>
        @break

    @case('accepted')
        <span class="tag is-success">Accepté</span>
        @break

    @case('taken')
        <span class="tag is-primary">En run</span>
        @break

    @case('not-requested')
        <span class="tag is-warning">Pas requis</span>
        @break

    @case('requested')
        <span class="tag is-info">Demandé</span>
        @break

    @case('not-present')
        <span class="tag is-danger">Pas présent</span>
        @break

    @case('free')
        <span class="tag is-success">Free</span>
        @break

    @default
        <span class="tag is-light">Aucun status</span>
@endswitch