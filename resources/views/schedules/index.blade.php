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
    <link href="css/calendar/scheduler.css" rel="stylesheet">
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
                <h1 class="title is-2">{{ $festival->name }}</h1>
            </div>
            <div class="column is-4">
                <a href="{{ route('schedules.create') }}" class="button is-info is-pulled-right">Nouvel horaire</a>
            </div>
            <div class="column">
                tutu
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                @for ($i = 0; $i < $range; $i++)
                    <table class="table is-striped is-hoverable is-fullwidth">
                            <h2 class="title is-3">{{$beginFest->addDay()->format('l jS F Y')}}</h2>
                        <thead>
                            <tr>
                                <th>Groupe</th>
                                @for ($t = 0; $t < 47; $t++)
                                    <th>{{$someTime->addMinutes(30)->toTimeString()}}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Groupe</th>
                                @for ($t = 0; $t < 47; $t++)
                                    <th>{{$someTime->addMinutes(30)->toTimeString()}}</th>
                                @endfor
                            </tr>
                        </tfoot>

                        <tbody>


                            @foreach ($groups as $group)
                                <tr id="{{$group->name}}">
                                    <td>{{$group->name}}</td>
                                    @for ($t = 0; $t < 47; $t++)
                                        <td style></td>
                                    @endfor
                                </tr>
                            @endforeach
                            @foreach ($schedules as $schedule)
                                @if ($schedule->start_time >= '2018-04-17 00:00:00' && $schedule->start_time <= '2018-04-17 23:59:59')
                                    @foreach ($groups as $group)
                                        @if ($schedule->group_id === $group->id)
                                            (({{$group->name}}-{{$schedule->start_time->toTimeString()}}-{{$schedule->end_time->toTimeString()}})) //
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endfor
                </div>
            </div>
        </div>
    </div>





@endsection
