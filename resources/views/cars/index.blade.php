{{--
  -- Cars index
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Véhicules</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-8">
                <h1 class="title is-2">Liste des véhicules</h1>
            </div>
            <div class="column is-4">
                <a href="{{ route('cars.create') }}" class="button is-info is-pulled-right">Nouveau véhicule</a>
            </div>
        </div>
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
                    <tbody>
                        @foreach ($cars as $car)
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
        {{ $cars->links() }}
    </div>
</div>

@endsection
