{{--
  -- Cars index
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('cars.index') }}">Véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Véhicule {{ $car->model }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <div class="panel panel-default">
                    <div class="title is-2">Car {{$car->model}}</div>
                    <table class="table is-fullwidth">
                        <thead>
                            <tr>
                                <th>model</th>
                                <th>brand</th>
                                <th>plate number</th>
                                <th>color</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->plate_number }}</td>
                                <td>{{ $car->color }}</td>
                                <td>
                                    @component('components/status_tag', ['status' => $car->status])
                                    @endcomponent
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="field is-grouped buttons has-addons">
                        <a href="{{ route('cars.index') }}" class="button is-info">Back</a>
                        <form method="POST" class="form-horizontal" action="{{ route('cars.destroy', ['car' => $car->id]) }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="button is-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
