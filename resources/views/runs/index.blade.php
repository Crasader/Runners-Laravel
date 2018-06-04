{{--
  -- Runs index
  -- Show list of all the runs
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Liste des runs</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des runns</h1>
            </div>
            <div class="column">
                @can('create', App\Run::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('runs.create') }}" class="button is-info">Nouveau run</a>
                        </p>
                    </div>
                @endcan
            </div>
        </div>

        {{-- Filters --}}
        @component('components/filters_box', ['filters' => [
            "filtredColumns" => [
                "status" => [
                    "ready" => "Pret",
                    "gone" => "Démarré",
                    "error" => "Erreur",
                    "drafting" => "En préparation",
                    "finished" => "Terminé",
                    "needs_filling" => "Manque infos"
                ],
            ],
            "search" => "name",
            "orderBy" => [
                "name" => "Nom",
                "passengers" => "Nb passagers",
                "status" => "Status",
                "planned_at" => "Prévu à",
                "started_at" => "Démarré à",
            ]
        ]])
        @endcomponent

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Passagers</th>
                            <th>Status</th>
                            <th>Prévu à</th>
                            <th>Démarré à</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Passagers</th>
                            <th>Status</th>
                            <th>Prévu à</th>
                            <th>Démarré à</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($runs as $run)
                            <tr onclick="window.location.href = '{{ route('runs.show', ['user' => $run->id]) }}'">
                                <th>{{ $run->name }}</th>
                                <td>{{ $run->passengers }}</td>
                                <td>
                                    {{-- Status tag (see related component) --}}
                                    @component('components/status_tag', ['status' => $run->status])
                                    @endcomponent
                                </td>
                                <td>{{ $run->planned_at }}</td>
                                <td>{{ $run->started_at }}</td>
                                <td>
                                    {{-- Edition buttons --}}
                                    <div class="buttons has-addons is-right">
                                        <a href="{{-- route('runs.start', ['run' => $run->id]) --}}" class="button is-small is-link is-success">
                                            Démarrer
                                        </a>
                                        <a href="{{-- route('runs.stop', ['user' => $run->id]) --}}" class="button is-small is-link is-danger">
                                            Arréter
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $runs->links() }}

    </div>
</div>

@endsection