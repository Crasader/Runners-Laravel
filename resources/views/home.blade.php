@extends('layouts.app')

@section('content')
    <div class="section runners">
        <div class="container">
            <div class="columns">
                <div class="column is-12">
                    <a href="{{ route('users.index') }}">
                        <div class="notification is-warning">
                            <h2 class="title is-2 has-text-centered">Tous</h2>
                        </div>
                    </a>
                </div>
            </div>

            <div class="columns">
                <div class="column is-12">
                    <a href="{{-- route('kiela') --}}">
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
            </div>

            <div class="columns">
                <div class="column">
                    <a href="{{-- route('schedule.index') --}}">
                        <div class="notification is-info">
                            <h2 class="title is-2 has-text-centered">Planning</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
