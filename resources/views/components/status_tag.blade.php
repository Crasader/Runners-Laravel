{{--
  -- Status tag
  -- Display the right tag from the status value
  --
  -- @author Bastien Nicoud
  --}}

@switch($status)
    @case('active')
        <span class="tag {{ $slot }} is-success">Disponible</span>
        @break

    @case('free')
        <span class="tag {{ $slot }} is-success">Disponible</span>
        @break

    @case('accepted')
        <span class="tag {{ $slot }} is-success">Accepté</span>
        @break

    @case('taken')
        <span class="tag {{ $slot }} is-primary">En run</span>
        @break

    @case('not-requested')
        <span class="tag {{ $slot }} is-warning">Pas requis</span>
        @break

    @case('requested')
        <span class="tag {{ $slot }} is-info">Demandé</span>
        @break

    @case('not-present')
        <span class="tag {{ $slot }} is-danger">Pas présent</span>
        @break

    @case('free')
        <span class="tag {{ $slot }} is-success">Libre</span>
        @break

    @case('problem')
        <span class="tag {{ $slot }} is-danger">Problème</span>
        @break

    @case('finished')
        <span class="tag {{ $slot }} is-white">Terminé</span>
        @break

    @case('empty')
        <span class="tag {{ $slot }} is-warning">Vide</span>
        @break

    @case('needs_filling')
        <span class="tag {{ $slot }} is-warning">A compléter</span>
        @break

    @case('gone')
        <span class="tag {{ $slot }} is-info">Démarré</span>
        @break

    @case('ready')
        <span class="tag {{ $slot }} is-success">Prêt</span>
        @break

    @case('drafting')
        <span class="tag {{ $slot }} is-dark">Non publié</span>
        @break

    @case('error')
        <span class="tag {{ $slot }} is-danger">Problème !!</span>
        @break

    @case('hors_service')
    <span class="tag is-light">Hors service</span>
        @break

    @default
        <span class="tag {{ $slot }} is-light">Aucun status</span>
@endswitch
