{{--
  -- Show specified group
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('artists.index') }}">Artistes</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $artist->name }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">{{ $artist->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $artist)
                        <p class="control">
                            <a href="{{ route('artists.edit', ['artist' => $artist->id]) }}" class="button is-info">Modifier l'artiste</a>
                        </p>
                    @endcan
                    @can('delete', $artist)
                        <form id="delete-artist-form"
                            action="{{ route('artists.destroy', ['artist' => $artist->id]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-artist-form').submit();"
                                class="button is-danger">
                                Supprimer : {{ $artist->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <h2 class="title is-3">Runs pour le groupe</h2>
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
                        @forelse ($artist->runs()->orderBy('planned_at')->get() as $run)
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
                                        <strong>Aucun run pour cet artiste<strong>
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