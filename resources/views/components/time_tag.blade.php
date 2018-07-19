{{--
  -- Date tag
  -- Display dates with a tag layout
  --
  -- @author Xavier Carrel
  --}}

@if($date)
    <span class="tag">
            <strong>
                {{ $date->format('H:i') }}
            </strong>
        </span>
@endif