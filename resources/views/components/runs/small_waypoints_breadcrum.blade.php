{{--
  -- Waypoints breadcrum
  -- Display the run waypoints for the big screen
  --
  -- @author Bastien Nicoud/Xavier Carrel
  --}}

<div>
    @foreach ($run->waypoints as $waypoint)
        {{ $waypoint->name }}
        @unless ($loop->last)
            &nbsp;<i class="fas fa-arrow-right"></i>&nbsp;
        @endunless
    @endforeach
</div>