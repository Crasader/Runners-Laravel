{{--
  -- Show specified car type
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('carTypes.index') }}">Types de véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $carType->name }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
      {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Type {{ $carType->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $carType)
                        <p class="control">
                            <a href="{{ route('carTypes.edit', ['carType' => $carType->id]) }}" class="button is-info">Modifier le véhicule</a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-12">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Nombre de place</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $carType->name }}</td>
                            <td>{{ $carType->description }}</td>
                            <td>{{ $carType->nb_place }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="columns">
            <div class="column">
                <h2 class="title is-3">Véhicules de ce type</h2>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Numéro de plaque</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Numéro de plaque</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($carType->cars as $car)
                            <tr onclick="window.location.href = '{{ route('cars.show', ['car' => $car->id]) }}'">
                                <td>{{$car->name}}</td>
                                <td>{{$car->plate_number}}</td>
                                <td>
                                    @component('components/status_tag', ['status' => $car->status])
                                    @endcomponent
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
