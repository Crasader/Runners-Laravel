@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">
            <div class="title is-2">Cartype list</div>
            <hr>
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>description</th>
                        <th>number place</th>
                        <th><a href="{{ Route('cartypes.create') }}" class="button is-info">Create a car type</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartypes as $cartype)
                        <tr>
                            <td>{{$cartype->name}}</td>
                            <td>{{$cartype->description}}</td>
                            <td>{{$cartype->nb_place}}</td>
                            <td><a href="" class="button is-warning"></a><a href="" class="button is-danger"></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
