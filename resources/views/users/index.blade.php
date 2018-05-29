{{--
  -- Users index
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Utilisateurs</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des runners</h1>
            </div>
            <div class="column">
                @can('create', App\User::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('users.create') }}" class="button is-info">Nouvel utilisateur</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('users.import-form') }}" class="button is-primary">Importer une liste</a>
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
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Nom d'utilisateur</th>
                            <th>E-mail</th>
                            <th>Tel</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Nom d'utilisateur</th>
                            <th>E-mail</th>
                            <th>Tel</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $user->firstname }}</th>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>
                                    {{-- Status tag (see related component) --}}
                                    @statustag(['status' => $user->status])
                                    @endstatustag
                                </td>
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

        {{-- Pagination links --}}
        {{ $users->links() }}

    </div>
</div>

@endsection