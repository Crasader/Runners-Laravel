{{--
  -- Show specific role
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('roles.index') }}">Roles</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $role->name }}</a></li>
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
                    @can('delete', $role)
                        <p class="control">
                            <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="button is-info">Modifier le role</a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

    </div>
</div>
@endsection