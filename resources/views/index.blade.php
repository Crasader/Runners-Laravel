@extends('layouts.app')

@section('content')
    <div class="section homepage">
        <div class="container">
            <div class="columns">
                <div class="column is-half">
                    <a href="{{ route('runs.index') }}">
                        <div class="notification is-warning">
                            <h2 class="title is-2 has-text-centered">Runs</h2>
                        </div>
                    </a>
                </div>
                
                <div class="column is-half">
                    <a href="{{ route('users.index') }}">
                        <div class="notification is-primary">
                            <h2 class="title is-2 has-text-centered">Chauffeurs</h2>
                        </div>
                    </a>
                </div>
            </div>

            <div class="columns">
                <div class="column is-half">
                    <a href="{{ route('cars.index')}}">
                        <div class="notification is-success">
                            <h2 class="title is-2 has-text-centered">Véhicules</h2>
                        </div>
                    </a>
                </div>
                
                <div class="column is-half">
                    <a href="{{ route('stats.index') }}">
                        <div class="notification is-info">
                            <h2 class="title is-2 has-text-centered">Stats</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
