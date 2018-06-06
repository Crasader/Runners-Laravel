{{--
  -- Run Waypoint box
  --
  -- @author Bastien Nicoud
  --}}

<div class="content box">
    @foreach($waypoints as $waypoint)
        <p>
            {{ $waypoint->positionToString() }}
            <span class="tag">
                <strong>
                    {{ $waypoint->name }}
                </strong>
            </span>
        </p>
    @endforeach
</div>