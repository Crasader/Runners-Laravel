{{--
  -- Waypoints breadcrum
  -- Display the run waypoints for the big screen
  --
  -- @author Bastien Nicoud
  --}}

<h3 class="title is-5 title-run">
    @foreach ($run->waypoints as $waypoint)
        {{ $waypoint->name }}
        @unless ($loop->last)
            &nbsp;<i class="fas fa-arrow-right"></i>&nbsp;
        @endunless
    @endforeach
</h3>