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

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    Horaire pour :
                    <span class="tag is-large" style="background-color: #{{ $schedule->group->color }};">{{ $schedule->group->name }}</span>
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $schedule)
                        <p class="control">
                            <a href="{{ route('schedules.edit', ['schedule' => $schedule->id]) }}" class="button is-info">Modifier l'horaire</a>
                        </p>
                    @endcan
                    @can('delete', $schedule)
                        <form id="delete-schedule-form"
                            action="{{ route('schedules.destroy', ['schedule' => $schedule->id]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-schedule-form').submit();"
                                class="button is-danger">
                                Supprimer l'horaire
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="content box">
                    @datetag(['date' => $schedule->start_time])
                        Commence :
                    @enddatetag
                    @datetag(['date' => $schedule->end_time])
                        Termine
                    @enddatetag
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <h2 class="title is-3">Utilisateurs concernées par cet horaire :</h2>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <div class="box">
                    <div class="columns is-multiline">
                        @foreach ($schedule->group->users as $user)
                            <div class="column is-2">
                                <figure class="image">
                                    <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                                </figure>
                                <p class="has-text-centered has-margin-top-10">
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                        <span class="tag is-medium" style="background-color: #{{ $schedule->group->color }};">
                                            {{$user->firstname}}
                                        </span>
                                    </a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
