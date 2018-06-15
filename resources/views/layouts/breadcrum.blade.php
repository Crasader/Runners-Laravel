{{--
  -- Breadcrum
  -- Little breadcrup to display on top of pages
  --
  -- @author Bastien Nicoud
  --}}

<div class="container breadcrum-spacing">
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <a href="{{ route('home') }}">
                    <span class="icon is-small">
                        <i class="fas fa-home" aria-hidden="true"></i>
                    </span>
                    <span>Home</span>
                </a>
            </li>
            @yield('breadcrum')
        </ul>
    </nav>
</div>