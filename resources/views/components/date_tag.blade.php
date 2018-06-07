{{--
  -- Date tag
  -- Display dates with a tag
  --
  -- @author Bastien Nicoud
  --}}

@if($date)
    <p>
        {{ $slot }}
        <span class="tag">
            <strong>
                {{ $date->formatLocalized('%A %d %B') }}
            </strong>
        </span>
        à
        <span class="tag">
            <strong>
                {{ $date->format('H \h i') }}
            </strong>
        </span>
    </p>
@else
    <p>
        {{ $slot }}
        <span class="tag">
            <strong>
                -
            </strong>
        </span>
    </p>
@endif