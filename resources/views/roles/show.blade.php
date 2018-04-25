{{--
  -- Show specific role
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('roles.index') }}">Roles</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $role->slug }}</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">


        {{-- --------------------- --}}
        {{-- HEADER                --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-narrow">
                    {{ $role->name }}
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $role)
                        <p class="control">
                            <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="button is-info">Modifier le role</a>
                        </p>
                    @endcan
                    {{-- The delete button is not displayed if the role has users --}}
                    @if(!$role->users()->exists())
                        @can('delete', $role)
                            <p class="control">
                                <form id="delete-role-form"
                                    action="{{ route('roles.destroy', ['role' => $role->id]) }}"
                                        method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <button onclick="event.preventDefault();
                                    document.getElementById('delete-role-form').submit();"
                                    class="button is-danger">
                                    Supprimer le role : {{ $role->slug }}
                                </button>
                            </p>
                        @endcan
                    @endif
                </div>
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Etat</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Permission</th>
                            <th>Etat</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($role->permissions as $permission => $state)
                            <tr>
                                <th>{{ $permission }}</th>
                                <td>{{ $state == 'true' ? 'Autorisé' : 'Non autorisé' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection