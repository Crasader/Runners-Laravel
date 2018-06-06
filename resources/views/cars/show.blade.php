{{--
  -- Show specified car
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('cars.index') }}">Véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $car->name }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">{{ $car->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $car)
                        <p class="control">
                            <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="button is-info">Modifier le véhicule</a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Numéro de plaque</th>
                            <th>Couleur</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->type->name }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->plate_number }}</td>
                            <td>{{ $car->color }}</td>
                            <td>
                                @component('components/status_tag', ['status' => $car->status])
                                @endcomponent
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="columns">
                <div class="column">
                    <h2 class="title is-3">Runs utilisant ce véhicule</h2>
                </div>
            </div>

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
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Passagers</th>
                            <th>Status</th>
                            <th>Prévu à</th>
                            <th>Démarré à</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($car->runs()->orderBy('planned_at', 'asc')->where('planned_at', '>=', Carbon\Carbon::now())->get() as $run)
                            <tr onclick="window.location.href = '{{ route('runs.show', ['user' => $run->id]) }}'">
                                <th>{{ $run->name }}</th>
                                <td>{{ $run->passengers }}</td>
                                <td>
                                    {{-- Status tag (see related component) --}}
                                    @component('components/status_tag', ['status' => $run->status])
                                    @endcomponent
                                </td>
                                <td>
                                    {{ $run->planned_at }}
                                </td>
                                <td>
                                    {{ $run->started_at }}
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
