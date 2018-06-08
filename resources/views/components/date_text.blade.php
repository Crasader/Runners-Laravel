{{--
  -- Date with days in french
  -- Display dates in simple text
  --
  -- @author Bastien Nicoud
  --}}

@if($date)
    <p>
        {{ $slot }}
        <strong>
            {{ $date->formatLocalized('%A %d') }}
        </strong>
        à
        <strong>
            {{ $date->format('H \h i') }}
        </strong>
    </p>
@else
    <p>
        {{ $slot }}
        <strong>
            -
        </strong>
    </p>
@endif