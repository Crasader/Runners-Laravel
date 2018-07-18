{{--
  -- Update tag
  -- Returns a 'new stuff' mark if the date is less than 15 minutes in the past
  --
  -- @author Xavier Carrel
  --}}

@if (\Carbon\Carbon::parse($date)->diffInMinutes(Carbon\Carbon::now()) < 15)
    <br><i class="fas fa-exclamation-triangle media-right"  style="color:#d8dd1d;"></i>
@endif
