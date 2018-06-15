<nav class="navbar is-light is-spaced">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('infos') }}">
                <img src="/img/logo.svg" alt="Runners" width="112" height="28">
            </a>
            <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>

        <div id="navMenu" class="navbar-menu">
            <div class="navbar-start">

                {{-- Runs menu --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('runs.index') }}?filter-column=status&filter%5B%5D=ready&filter%5B%5D=gone&filter%5B%5D=error&filter%5B%5D=drafting&filter%5B%5D=needs_filling&needle=&search=name">
                        Runs
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('runs.big') }}">
                            Grand affichage
                        </a>
                        <a class="navbar-item" href="{{ route('runs.index') }}?filter-column=status&filter%5B%5D=ready&filter%5B%5D=gone&filter%5B%5D=error&filter%5B%5D=drafting&filter%5B%5D=needs_filling&needle=&search=name">
                            Afficher les runs
                        </a>
                        @can('create', App\Run::class)
                            <a class="navbar-item" href="{{ route('runs.create') }}">
                                Créer un run
                            </a>
                        @endcan
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
                            Afficher les véhicules
                        </a>
                        @can('create', App\Car::class)
                            <a class="navbar-item" href="{{ route('cars.create') }}">
                                Créer un véhicule
                            </a>
                        @endcan
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{ route('carTypes.index') }}">
                            Afficher les types de véhicules
                        </a>
                        @can('create', App\CarType::class)
                            <a class="navbar-item" href="{{ route('carTypes.create') }}">
                                Créer un type de véhicule
                            </a>
                        @endcan
                    </div>
                </div>

                {{-- Runners menu (users) --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('users.index') }}">
                        Chauffeurs
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('users.index') }}">
                            Afficher les chauffeurs
                        </a>
                        @can('create', App\User::class)
                            <a class="navbar-item" href="{{ route('users.create') }}">
                                Créer un chauffeur
                            </a>
                        @endcan
                        <a class="navbar-item" href="{{ route('users.import-form') }}">
                            Importer des chauffeurs
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
                        @can('create', App\Group::class)
                            <a class="navbar-item" href="{{ route('groups.create') }}">
                                Créer un groupe
                            </a>
                        @endcan
                    </div>
                </div>

                {{-- Groups menu --}}
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="{{ route('schedules.index') }}">
                        Horaires
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('schedules.create') }}">
                            Créer un nouver horaire
                        </a>
                    </div>
                </div>

                {{-- Kiéla? menu --}}
                <a class="navbar-item" href="{{ route('kiela.index') }}">
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
                    <a class="navbar-item" href="{{ route('login') }}">Connexion</a>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="{{ route('me') }}">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span>
                                {{ Auth::user()->name }}
                            </span>
                            @if (Auth::user()->unreadNotifications()->count())
                                &nbsp;
                                <span class="tag is-rounded is-dark">{{ Auth::user()->unreadNotifications()->count() }}</span>
                            @endif
                        </a>
                        <div class="navbar-dropdown is-right is-boxed">
                            <a class="navbar-item" href="{{ route('home') }}">
                                Home
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="{{ route('me') }}">
                                Mon compte
                            </a>
                            <a class="navbar-item" href="{{ route('notifications.index') }}">
                                <span class="tag is-rounded is-dark">{{ Auth::user()->unreadNotifications()->count() }}</span>&nbsp;Notifications
                            </a>
                            {{-- Logs page --}}
                            @can('view', App\Log::class)
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="{{ route('logs.index') }}">
                                    Logs
                                </a>
                            @endcan
                            @can('view', App\Role::class)
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="{{ route('roles.index') }}">
                                    Gèrer les roles
                                </a>
                            @endcan
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Déconnexion
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