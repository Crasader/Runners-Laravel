@extends('layouts.app')

@section('content')
    <div class="section runners homepage">
        <div class="container">
            <div class="columns">
                <div class="column is-half">
                    <a href="{{ route('users.index') }}">
                        <div class="notification is-warning">
                            <h2 class="title is-2 has-text-centered">Chauffeurs</h2>
                        </div>
                    </a>
                </div>

                <div class="column is-half">
                    <a href="{{ route('kiela.index') }}">
                        <div class="notification is-primary">
                            <h2 class="title is-2 has-text-centered">Kiéla?</h2>
                        </div>
                    </a>
                </div>
            </div>

            <div class="columns">
                <div class="column is-half">
                    <a href="{{ route('groups.manager') }}">
                        <div class="notification is-success">
                            <h2 class="title is-2 has-text-centered">Groupes</h2>
                        </div>
                    </a>
                </div>

                <div class="column is-half">
                    <a href="{{ route('schedules.index') }}">
                        <div class="notification is-info">
                            <h2 class="title is-2 has-text-centered">Planning</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
