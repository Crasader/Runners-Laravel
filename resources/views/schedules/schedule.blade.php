{{--
    -- Schedule component
    --
    -- @author Nicolas Henry, Bastien Nicoud
    --}}

id: {{$schedule->id}}
start: {{$schedule->start_time->toTimeString()}}
end: {{$schedule->end_time->toTimeString()}}
<div class="schedule-box">
    <div
        class="schedule-element cursor-pointer"
        onclick="window.location.href = '{{ route('schedules.edit', ['schedule' => $schedule->id]) }}'"
        {{-- Sets the width of the box debending the schedule time --}}
        style="width: {{ $schedule->lengthInPercent() }}%; margin-left: {{ $schedule->timeFromDawnInPercent() }}%;">
        {{ $schedule->lengthInPercent() }} % et {{ $schedule->timeFromDawnInPercent() }} %
    </div>

</div>
