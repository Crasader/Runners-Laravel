{{--
  -- Cartypes index
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Types de véhicule</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-8">
                <h1 class="title is-2">Liste des types véhicules</h1>
            </div>
            <div class="column is-4">
                <a href="{{ route('carTypes.create') }}" class="button is-info is-pulled-right">Nouveau type de véhicule</a>
            </div>
        </div>
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Nombre de place</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Nombre de place</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($carTypes as $carType)
                            <tr onclick="window.location.href = '{{ route('carTypes.show', ['carType' => $carType->id]) }}'">
                                <th>{{$carType->name}}</th>
                                <td>{{$carType->description}}</td>
                                <td>{{$carType->nb_place}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $carTypes->links() }}
    </div>
</div>


@endsection
