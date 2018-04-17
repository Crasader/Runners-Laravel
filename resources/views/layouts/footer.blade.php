<footer class="footer">
    <div class="container">
        <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
            <ul>
                <li>
                    <a href="/">
                        <span class="icon is-small">
                            <i class="fas fa-home" aria-hidden="true"></i>
                        </span>
                        <span>Home</span>
                    </a>
                </li>
                @yield('breadcrum')
            </ul>
        </nav>
        <div class="content has-text-centered">
            <p>
                <strong>Runners</strong> by <a href="https://github.com/bastiennicoud">Bastien Nicoud</a> and<a href="https://github.com/NicolasHenryCPNV"> Nicolas Henry</a>
                ©CPNV - {{ date("Y") }}
            </p>
        </div>
    </div>
</footer>