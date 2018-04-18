{{--
  -- Footer
  -- Included in all pages
  --
  -- @author Bastien Nicoud
  --}}

<footer class="footer">
    <div class="container">

        {{-- Display the breadcrum on the bottom of the page (not the same as at the top of the page) --}}
        <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
            <ul>
                {{-- base part --}}
                <li>
                    <a href="/">
                        <span class="icon is-small">
                            <i class="fas fa-home" aria-hidden="true"></i>
                        </span>
                        <span>Home</span>
                    </a>
                </li>
                {{-- Display the breadcrum (from the blade section of each page) --}}
                @yield('breadcrum')
            </ul>
        </nav>

        {{-- Copyright --}}
        <div class="content has-text-centered">
            <p>
                <strong><a href="https://github.com/CPNV-ES/Runners-Laravel">Runners</a></strong> by 
                <a href="https://github.com/bastiennicoud">Bastien Nicoud</a> and
                <a href="https://github.com/NicolasHenryCPNV"> Nicolas Henry</a>
                ©CPNV - {{ date("Y") }}
            </p>
        </div>

    </div>
</footer>