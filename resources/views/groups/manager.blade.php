{{--
  -- Show group details
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('groups.index') }}">Groups</a></li>
<li class="is-active"><a href="#" aria-current="page">Manager</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/groups/manager.js') }}"></script>
@endpush
  
@section('content')

<div class="section">
    <div class="container">

        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Gestion des groupes</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', App\Group::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-groups-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="columns">
            <div class="column is-12">
                filters
            </div>
        </div>

        <form id="update-groups-form" action="{{ route('groups.manager.update') }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="columns is-multiline">
                @foreach($groups as $group)
                    <div class="column is-4">
                        <div class="box" style="background-color: #{{ $group->color }};">
                            <div class="content">
                                <h2>{{ $group->name }}</h2>
                                <ul data-group-id="{{ $group->id }}">
                                    @foreach($group->users as $user)
                                        <li class="cursor-pointer">
                                            <input type="text" name="user[{{ $user->id }}]" value="{{ $group->id }}" style="display: none;">
                                            {{ $user->fullname }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="columns">
                <div class="column">
                    <button class="button" type="submit">Envoyer</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection