@extends('layouts.app')

@section('content')
    <div class="section runners homepage">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <a href="{{ route('runs.index') }}">
                        <div class="notification is-warning">
                            <h2 class="title is-2 has-text-centered">Runs</h2>
                        </div>
                    </a>
                </div>

                <div class="column">
                    <a href="{{ route('users.index') }}">
                        <div class="notification is-info">
                            <h2 class="title is-2 has-text-centered">Chauffeurs</h2>
                        </div>
                    </a>
                </div>

                <div class="column">
                    <a href="{{ route('kiela.index') }}">
                        <div class="notification is-primary">
                            <h2 class="title is-2 has-text-centered">Kiéla?</h2>
                        </div>
                    </a>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <a href="{{ route('groups.manager') }}">
                        <div class="notification is-success">
                            <h2 class="title is-2 has-text-centered">Groupes</h2>
                        </div>
                    </a>
                </div>

                <div class="column">
                    <a href="{{ route('schedules.index') }}">
                        <div class="notification is-danger">
                            <h2 class="title is-2 has-text-centered">Planning</h2>
                        </div>
                    </a>
                </div>

                <div class="column">
                    <a href="{{ route('statistics.index') }}">
                        <div class="notification is-link">
                            <h2 class="title is-2 has-text-centered">Statistiques</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
