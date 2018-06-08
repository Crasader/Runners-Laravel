{{--
  -- Date tag
  -- Display dates in simple text
  --
  -- @author Bastien Nicoud
  --}}

@if($date)
    <p>
        {{ $slot }}
        <strong>
            {{ $date->format('d-m-Y') }}
        </strong>
        à
        <strong>
            {{ $date->format('H:i:s') }}
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