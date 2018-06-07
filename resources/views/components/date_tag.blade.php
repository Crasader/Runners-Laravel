{{--
  -- Date tag
  -- Display dates with a tag layout
  --
  -- @author Bastien Nicoud
  --}}

@if($date)
    <p>
        {{ $slot }}
        <span class="tag">
            <strong>
                {{ $date->formatLocalized('%A') }}
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