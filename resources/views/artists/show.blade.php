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

        {{-- Filters --}}
        <div class="columns">
            <div class="column is-12">
                filters
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
                            <th>Départ prévu à</th>
                            <th>A démarré</th>
                            <th>A terminé</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Status</th>
                            <th>Départ prévu à</th>
                            <th>A démarré</th>
                            <th>A terminé</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($artist->runs as $run)
                            <tr>
                                <th>{{ $run->name }}</th>
                                {{-- Display a tag with the group background color --}}
                                <th>
                                    {{-- Status tag (see related component) --}}
                                    @component('components/status_tag', ['status' => $run->status])
                                    @endcomponent
                                </th>
                                <td>{{ $run->planned_at->format(' j F Y H:i:s') }}</td>
                                <td>{{ $run->started_at->format(' j F Y H:i:s') }}</td>
                                <td>{{ $run->ended_at->format(' j F Y H:i:s') }}</td>
                                <td>
                                    {{-- Edition buttons --}}
                                    <div class="buttons has-addons is-right">
                                        <a href="{{ route('runs.edit', ['run' => $run->id]) }}" class="button is-small is-link">
                                            Edit
                                        </a>
                                        <a href="{{ route('runs.show', ['run' => $run->id]) }}" class="button is-small is-link">
                                            Show
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection