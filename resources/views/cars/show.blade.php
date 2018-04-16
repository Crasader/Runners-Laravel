@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">
            <div class="panel panel-default">
                <div class="title is-2">Car {{$car->plate_number}}</div>

                <hr>
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>plate number</th>
                            <th>brand</th>
                            <th>model</th>
                            <th>color</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $car->plate_number }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->color }}</td>
                            <td>{{ $car->status }}</td>
                        </tr>
                    </tbody>
                </table>

                    <a href="{{ route('cars.index') }}" class="button is-info">Back</a>
                    <a href=""></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
