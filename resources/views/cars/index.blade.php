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
                            <th>name</th>
                            <th>brand</th>
                            <th>plate number</th>
                            <th>color</th>
                            <th>status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>name</th>
                            <th>brand</th>
                            <th>plate number</th>
                            <th>color</th>
                            <th>status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <th>{{$car->model}}</th>
                                <td>{{$car->brand}}</td>
                                <td>{{$car->plate_number}}</td>
                                <td>{{$car->color}}</td>
                                <td>
                                    @component('components/status_tag', ['status' => $car->status])
                                    @endcomponent
                                </td>
                                <td>
                                    <div class="buttons has-addons is-right">
                                        <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="button is-small is-link">
                                            Edit
                                        </a>
                                        <a href="{{ route('cars.show', ['car' => $car->id]) }}" class="button is-small is-link">
                                            Show
                                        </a>
                                    </div>
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
