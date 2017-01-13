@extends("layouts.app")

@section("content")
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('car') }}">Car Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('car') }}">View All Car</a></li>
        <li><a href="{{ URL::to('car/create') }}">Create a Car</a>
    </ul>
</nav>

<h1>Edit {{ $car->name }}</h1>
@include("partials.car.create")
@endsection
