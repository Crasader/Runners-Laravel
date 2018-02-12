<nav class="navbar is-light">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="/img/logo.svg" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
            </a>
            <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="navbar-menu">
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="/runs">
                        Runs
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="/runs/create">
                            Créer run
                        </a>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="/vehicules">
                        Véhicules
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="/vehicule/create">
                            Créer véhicule
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="/vehicule/create">
                            Créer type de véhicule
                        </a>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="/chauffeurs">
                        Chauffeurs
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="/chauffeurs/create">
                            Créer chauffeurs
                        </a>
                    </div>
                </div>
                <a class="navbar-item" href="/groupes">
                    Groupes
                </a>
                <a class="navbar-item" href="/horaires">
                    Horaires
                </a>
            </div>

            <div class="navbar-end">
                <!-- Authentication Links -->
                @guest
                    <a class="navbar-item" href="{{ route('login') }}">Login</a>
                    <a class="navbar-item" href="{{ route('register') }}">Register</a>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="/documentation/overview/start/">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="navbar-dropdown is-boxed">
                            <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>