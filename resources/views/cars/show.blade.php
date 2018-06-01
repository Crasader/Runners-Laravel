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
    </div>
</div>

@endsection
