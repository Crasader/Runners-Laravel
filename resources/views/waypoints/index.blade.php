{{--
  -- Waypoints index
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Lieux</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des lieux enregistrés</h1>
            </div>
            <div class="column">
                @can('create', App\Waypoint::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('waypoints.create') }}" class="button is-info">Nouveau lieu</a>
                        </p>
                    </div>
                @endcan
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Utilisation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Utilisation</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($waypoints as $waypoint)
                            <tr onclick="window.location.href = '{{ route('waypoints.show', ['waypoint' => $waypoint->id]) }}'">
                                <th>{{ $waypoint->name }}</th>
                                <td>
                                    <span class="tag is-light">
                                        <strong>{{ $waypoint->runs()->count() }}</strong>
                                    </span>
                                    run passent par ce lieu.
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $waypoints->links() }}

    </div>
</div>

@endsection