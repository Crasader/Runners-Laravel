{{--
  -- Show specified group
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('groups.index') }}">Groupes</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $group->name }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Groupe <span class="tag is-large" style="background-color: #{{ $group->color }};">{{ $group->name }}</span></h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <a href="{{ route('groups.create') }}" class="button is-info">Horaire du groupe</a>
                    </p>
                    @can('update', $group)
                        <p class="control">
                            <a href="{{ route('groups.edit', ['group' => $group->id]) }}" class="button is-info">Modifier le groupe</a>
                        </p>
                    @endcan
                    @can('delete', $group)
                        <form id="delete-group-form"
                            action="{{ route('groups.destroy', ['group' => $group->id]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-group-form').submit();"
                                class="button is-danger">
                                Supprimer le groupe : {{ $group->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <h2 class="title is-3">Utilisateurs appartenant au groupe</h2>
            </div>
        </div>

        {{-- Filters --}}
        <div class="columns">
            <div class="column is-12">
                filters
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($group->users as $user)
                            <tr>
                                <th>{{ $user->fullname }}</th>
                                {{-- Display a tag with the group background color --}}
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{-- Edition buttons --}}
                                    <div class="buttons has-addons is-right">
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="button is-small is-link">
                                            Edit
                                        </a>
                                        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="button is-small is-link">
                                            Show
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection