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
        @component('components/filters_box', ['filters' => [
            //"filtredColumns" => [
            //    "status" => [
            //        "not-present" => "Pas présent",
            //        "not-requested" => "Non demandé",
            //        "free" => "Libre",
            //        "requested" => "Demandé",
            //        "gone" => "En run"
            //    ],
            //],
            "search" => "firstname",
            "orderBy" => [
                "lastname" => "Nom de famille",
                "firstname" => "Prénom",
                "email" => "E-mail",
                "phone_number" => "Tel",
                "status" => "Status",
            ]
        ]])
        @endcomponent

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>E-mail</th>
                            <th>Tel</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr onclick="window.location.href = '{{ route('users.show', ['user' => $user->id]) }}'">
                                <td>{{ $user->firstname }}</td>
                                <th>{{ $user->lastname }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>
                                    {{-- Status tag (see related component) --}}
                                    @statustag(['status' => $user->status()->slug])
                                    @endstatustag
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $users->appends(request()->except('page'))->links() }}

    </div>
</div>

@endsection
