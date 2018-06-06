{{--
  -- Roles index
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Gestion des rôles</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des rôles</h1>
            </div>
            <div class="column">
                @can('create', App\Role::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('roles.create') }}" class="button is-info">Nouveau rôle</a>
                        </p>
                    </div>
                @endcan
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
                            <th>Slug</th>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Slug</th>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th>{{ $role->slug }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    {{-- Edition buttons --}}
                                    <div class="buttons has-addons is-right">
                                        <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="button is-small is-link">
                                            Edit
                                        </a>
                                        <a href="{{ route('roles.show', ['role' => $role->id]) }}" class="button is-small is-link">
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