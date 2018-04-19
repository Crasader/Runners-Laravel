{{--
  -- Show specified user
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Utilisateur</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $user->name }}</a></li>
@endsection
  
@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    {{ $user->fullname }}
                    @component('components/status_tag', ['status' => $user->status])
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                @can('create', App\User::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('users.create') }}" class="button is-info">Modifier l'utilisateur</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('users.create') }}" class="button is-warning">Générer QR code</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('users.create') }}" class="button is-warning">Générer Identifiants</a>
                        </p>
                    </div>
                @endcan
            </div>
        </div>
        <div class="columns">
            <div class="column is-3">
                @if ($user->qrCode()->exists())
                    <figure class="image">
                        <img src="{{ asset(Storage::url($user->qrCode->first()->path)) }}">
                    </figure>
                @else
                    <div class="content">
                        <blockquote>Aucun <strong>qr code</strong> n'est généré pour {{ $user->fullname }}, 
                            la connexion a l'app mobile n'est donc pas possible.
                            @can('create', App\User::class)
                                <strong>Vous pouvez un <a href="{{ route('users.create') }}">générer un</a></strong>
                            @endcan
                        </blockquote>
                    </div>
                @endif
            </div>
            <div class="column is-9">
                <div class="columns">
                    <div class="column is-3 has-text-right">
                        <strong>Nom complet</strong>
                    </div>
                    <div class="column is-3">
                        {{ $user->fullname}}
                    </div>
                    <div class="column is-3 has-text-right">
                        <strong>Nom d'utilisateur</strong>
                    </div>
                    <div class="column is-3">
                        {{ $user->name}}
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column is-2 is-offset-1">
                <figure class="image">
                    <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                </figure>
            </div>
        </div>
    </div>
</div>

@endsection