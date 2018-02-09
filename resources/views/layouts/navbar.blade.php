<nav class="navbar is-transparent">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
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
                    <a class="navbar-link" href="/courses">
                        Courses
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="/courses/create">
                            Créer courses
                        </a>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="/voitures">
                        Voitures
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="/voitures/create">
                            Créer voiture
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