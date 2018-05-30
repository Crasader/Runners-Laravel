{{--
  -- Runs big page
  -- Display the runs for big screen display
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.big_app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Liste des runs</a></li>
@endsection

@push('styles')
    <link href="{{ mix('css/big_runs.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush

@section('content')

<div class="section">
    <div class="container is-fluid">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Prochains runs</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <a href="{{ route('runs.index') }}" class="button is-info">Retour</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Artiste</th>
                            <th>Passagers</th>
                            <th>Status</th>
                            <th>Prévu à</th>
                            <th>Démarré à</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Artiste</th>
                            <th>Passagers</th>
                            <th>Status</th>
                            <th>Prévu à</th>
                            <th>Démarré à</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($runs as $run)
                            <tr>
                                <th>{{ $run->name }}</th>
                                <td>{{ $run->artists->first()->name }}</td>
                                <td>{{ $run->passengers }}</td>
                                <td>
                                    {{-- Status tag (see related component) --}}
                                    @component('components/status_tag', ['status' => $run->status])
                                        is-large
                                    @endcomponent
                                </td>
                                <td>{{ $run->planned_at->toDateString() }} <strong>{{ $run->planned_at->toTimeString() }}</strong></td>
                                <td>{{ $run->started_at ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection