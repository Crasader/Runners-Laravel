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
                                <td>
                                    {{-- Status tag (see related component) --}}
                                    @logaction(['action' => $log->action])
                                    @endlogaction
                                </td>
                                <td>
                                    {{ $log->loggable->getTable() }}
                                    <span class="tag is-light">{{ $log->loggable->id }}</span>
                                </td>
                                @if($log->user()->count())
                                    <td>
                                        <a href="{{ route('users.show', ['user' => $log->user->id]) }}">
                                            {{ $log->user->fullname }}
                                        </a>
                                    </td>
                                @else
                                    <td>Migrations</td>
                                @endif
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