{{--
    -- Schedules show
    --
    -- @author Nicolas Henry
    --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('schedules.index') }}">Horaires</a></li>
<li><a href="{{ route('schedules.show', ['schedule' => $schedule->id]) }}">Groupe {{ $schedule->group->name }}</a></li>
@endsection

@section('content')

show

@endsection
