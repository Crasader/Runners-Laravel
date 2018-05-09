<nav class="navbar is-light is-spaced">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
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

                {{-- Runs menu --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('runs.index') }}">
                        Runs
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('runs.big') }}">
                            Grand affichage
                        </a>
                        <a class="navbar-item" href="{{ route('runs.index') }}">
                            Afficher runs
                        </a>
                        <a class="navbar-item" href="{{ route('runs.create') }}">
                            Créer run
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{ route('waypoints.index') }}">
                            Afficher les waypoints
                        </a>
                        @can('create', App\Artist::class)
                            <a class="navbar-item" href="{{ route('waypoints.create') }}">
                                Créer un waypoint
                            </a>
                        @endcan
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{ route('artists.index') }}">
                            Afficher les artistes
                        </a>
                        @can('create', App\Waypoint::class)
                            <a class="navbar-item" href="{{ route('artists.create') }}">
                                Créer un artiste
                            </a>
                        @endcan
                    </div>
                </div>

                {{-- Cars menu --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('cars.index') }}">
                        Véhicules
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('cars.index') }}">
                            Afficher véhicules
                        </a>
                        <a class="navbar-item" href="{{ route('cars.create') }}">
                            Créer véhicule
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{ route('carTypes.index') }}">
                            Afficher type de véhicule
                        </a>
                        <a class="navbar-item" href="{{ route('carTypes.create') }}">
                            Créer type de véhicule
                        </a>
                    </div>
                </div>

                {{-- Runners menu (users) --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('users.index') }}">
                        Chauffeurs
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('users.index') }}">
                            Afficher chauffeurs
                        </a>
                        <a class="navbar-item" href="{{ route('users.create') }}">
                            Créer chauffeurs
                        </a>
                        <a class="navbar-item" href="{{ route('users.import-form') }}">
                            Importer chauffeurs
                        </a>
                    </div>
                </div>

                {{-- Groups menu --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('groups.manager') }}">
                        Groupes
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('groups.manager') }}">
                            Manager de groupes
                        </a>
                        <a class="navbar-item" href="{{ route('groups.index') }}">
                            Liste des groupes
                        </a>
                        <a class="navbar-item" href="{{ route('groups.create') }}">
                            Créer un groupe
                        </a>
                    </div>
                </div>

                {{-- Schedule menu --}}
                <a class="navbar-item" href="{{ route('schedules.index')}}">
                    Horaires
                </a>

                {{-- Kiéla? menu --}}
                <a class="navbar-item" href="/horaires">
                    Kiéla?
                </a>
            </div>

            <div class="navbar-end">
                {{-- Groups menu --}}
                <a class="navbar-item" href="https://github.com/CPNV-ES/Runners-Laravel">
                    <strong>{{ config('app.version') }}</strong>
                </a>

                {{-- Authentication Links --}}
                @guest
                    <a class="navbar-item" href="{{ route('login') }}">Login</a>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="{{ route('me') }}">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span>
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <div class="navbar-dropdown is-right is-boxed">
                            <a class="navbar-item" href="{{ route('home') }}">
                                Home
                            </a>
                            <a class="navbar-item" href="{{ route('me') }}">
                                Mon compte
                            </a>
                            @can('view', App\Role::class)
                                <a class="navbar-item" href="{{ route('roles.index') }}">
                                    Gèrer les roles
                                </a>
                            @endcan
                            <hr class="navbar-divider">
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