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
        <div class="columns">
            <div class="column is-8">
                <h1 class="title is-2">Liste des runners</h1>
            </div>
            <div class="column is-4">
                <a href="{{ route('cars.create') }}" class="button is-info is-pulled-right">Nouvel utilisateur</a>
            </div>
        </div>
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <th>ID</th>
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
                                <td>{{ $user->id }}</td>
                                <th>{{ $user->firstname }}</th>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>
                                    @component('components/status_tag', ['status' => $user->status])
                                    @endcomponent
                                </td>
                                <td>
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
        {{ $users->links() }}
    </div>
</div>

@endsection