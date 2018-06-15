{{--
    -- Schedules index
    --
    -- @author Nicolas Henry, Bastien Nicoud
    --}}

@extends('layouts.app')

@section('breadcrum')
    <li><a href="#">Horaires</a></li>
@endsection

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
    </div>

    {{-- Schedules display --}}
    <div class="container is-fluid">
        {{-- Show schedules --}}
        <div class="columns">
            <div class="column has-text-centered">
                <h2 class="title is-4">Jour1</h2>
            </div>
        </div>
        @foreach ($schedules as $schedule)
            <div class="columns">
                <div class="column is-narrow">
                    <span class="tag is-medium" style="background-color: #{{ $schedule->group->color }};">
                        {{ $schedule->group->name }}
                    </span>
                </div>
                <div class="column">
                    @component('schedules/schedule', ['schedule' => $schedule])
                    @endcomponent
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
