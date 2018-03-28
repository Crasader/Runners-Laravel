@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">
            <div class="title is-2">Car list</div>
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
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{$car->plate_number}}</td>
                            <td>{{$car->brand}}</td>
                            <td>{{$car->model}}</td>
                            <td>{{$car->color}}</td>
                            <td>{{$car->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
