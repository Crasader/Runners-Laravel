{{--
  -- Show specified group
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('waypoints.index') }}">Lieux</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $waypoint->name }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">{{ $waypoint->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $waypoint)
                        <p class="control">
                            <a href="{{ route('waypoints.edit', ['waypoint' => $waypoint->id]) }}" class="button is-info">Modifier le lieu</a>
                        </p>
                    @endcan
                    @can('delete', $waypoint)
                        <form id="delete-waypoint-form"
                            action="{{ route('waypoints.destroy', ['waypoint' => $waypoint->id]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-waypoint-form').submit();"
                                class="button is-danger">
                                Supprimer : {{ $waypoint->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <h2 class="title is-3">Runs passant par ce lieu</h2>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Status</th>
                            <th>Départ prévu le</th>
                            <th>A démarré le</th>
                            <th>A terminé le</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Status</th>
                            <th>Départ prévu le</th>
                            <th>A démarré le</th>
                            <th>A terminé le</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($waypoint->runs()->orderBy('planned_at')->get() as $run)
                            <tr onclick="window.location.href = '{{ route('runs.show', ['run' => $run->id]) }}'">
                                <th>{{ $run->name }}</th>
                                {{-- Display a tag with the group background color --}}
                                <th>
                                    {{-- Status tag (see related component) --}}
                                    @component('components/status_tag', ['status' => $run->status])
                                    @endcomponent
                                </th>
                                <td>
                                    @datetag(['date' => $run->planned_at])
                                    @enddatetag
                                </td>
                                <td>
                                    @datetag(['date' => $run->started_at])
                                    @enddatetag
                                </td>
                                <td>
                                    @datetag(['date' => $run->ended_at])
                                    @enddatetag
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="tag is-warning is-medium">
                                        <strong>Aucun run passe par ce lieu.<strong>
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