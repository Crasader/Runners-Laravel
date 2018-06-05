{{--
  -- Users index
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Logs</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des logs sur l'application</h1>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Action</th>
                            <th>Resource</th>
                            <th>Utilisateur</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Action</th>
                            <th>Resource</th>
                            <th>Utilisateur</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->created_at->toDateString() }}</td>
                                <th>{{ $log->created_at->format('H:i:s') }}</th>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->loggable->getTable() }}</td>
                                <td>{{ $log->user()->count() ? $log->user->name : 'Migrations' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $logs->appends(request()->except('page'))->links() }}

    </div>
</div>

@endsection