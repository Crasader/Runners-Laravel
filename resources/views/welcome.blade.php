@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-half">
                <div class="notification is-warning">
                    <h2 class="title is-2 has-text-centered"><a href="#">Runs</a></h2>
                </div>
            </div>
            
            <div class="column is-half">
                <div class="notification is-primary">
                    <h2 class="title is-2 has-text-centered"><a href="#">Chauffeurs</a></h2>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                <div class="notification is-success">
                    <h2 class="title is-2 has-text-centered"><a href="#">Véhicules</a></h2>
                </div>
            </div>
            
            <div class="column is-half">
                <div class="notification is-info">
                    <h2 class="title is-2 has-text-centered"><a href="#">Stats</a></h2>
                </div>
            </div>
        </div>
    </div>
@endsection
