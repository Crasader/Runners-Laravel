{{--
    -- Schedules index
    --
    -- @author Nicolas Henry
    --}}

@extends('layouts.app')

@section('breadcrum')
    <li><a href="#">Horaires</a></li>
@endsection

@push('styles')
    <link href="css/calendar/fullcalendar.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ mix('js/pages/schedules/index.js') }}"></script>
@endpush

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Horaires et présences</h1>
            </div>
        </div>

        {{-- -- --}}
        <div class="columns">
            <div class="column is-12">
                <div id="schedule-calendar">

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
