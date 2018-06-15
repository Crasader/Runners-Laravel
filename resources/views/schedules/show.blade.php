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
                <h2 class="title is-3">Utilisateurs concernées par cet horaire :</h2>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Tel</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Tel</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($schedule->group->users as $user)
                            <tr onclick="window.location.href = '{{ route('users.show', ['user' => $user->id]) }}'">
                                <th>{{ $user->firstname }}</th>
                                <th>{{ $user->lastname }}</th>
                                <th>{{ $user->phone_number }}</th>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="tag is-warning is-medium">
                                        <strong>Aucun utilisateurs dans ce groupe.<strong>
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
