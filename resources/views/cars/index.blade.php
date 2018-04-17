{{--
  -- Cars index
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Car list</h1>
                <hr>
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>plate number</th>
                            <th>brand</th>
                            <th>model</th>
                            <th>color</th>
                            <th>status</th>
                            <th><a href="{{ Route('cars.create') }}" class="button is-info">Create a car</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <td>{{$car->plate_number}}</td>
                                <td>{{$car->brand}}</td>
                                <td>{{$car->model}}</td>
                                <td>{{$car->color}}</td>
                                <td>{{$car->status}}</td>
                                <td><a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="button is-warning">Modify</a><a href="{{ route('cars.show', ['car' => $car->id]) }}" class="button is-success">Show</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
