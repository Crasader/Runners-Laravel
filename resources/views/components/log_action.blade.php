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
        <span class="tag {{ $slot }} is-primary">Mise a jour</span>
        @break

    @case('deleted')
        <span class="tag {{ $slot }} is-danger">Suppression</span>
        @break

    @case('restored')
        <span class="tag {{ $slot }} is-dark">Réstoration</span>
        @break

    @case('login')
        <span class="tag {{ $slot }} is-info">Connexion a l'administration</span>
        @break

    @case('commented')
        <span class="tag {{ $slot }} is-info">Commenté</span>
        @break

    @case('logout')
        <span class="tag {{ $slot }} is-info">Déconnexion de l'administration</span>
        @break

    @case('qrcode-generated')
        <span class="tag {{ $slot }} is-info">QR code généré</span>
        @break

    @case('qrcode-deleted')
        <span class="tag {{ $slot }} is-info">QR code supprimé</span>
        @break

    @default
        <span class="tag {{ $slot }} is-light">Aucun status</span>
@endswitch