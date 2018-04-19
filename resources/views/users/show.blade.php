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

        {{-- HEADER --}}
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
                            <a href="{{ route('users.create') }}" class="button is-small is-info">Modifier l'utilisateur</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('users.create') }}" class="button is-small is-warning">Générer QR code</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('users.create') }}" class="button is-small is-warning">Générer Identifiants</a>
                        </p>
                    </div>
                @endcan
            </div>
        </div>

        <div class="columns">
            <div class="column is-4">
                <h2 class="title is-3">QR code</h2>
            </div>
            <div class="column is-8">
                <h2 class="title is-3">Informations</h2>
            </div>
        </div>

        {{-- QR code infos --}}
        <div class="columns">
            <div class="column is-4">
                @if ($user->qrCode()->exists())
                    <figure class="image">
                        <img src="{{ asset(Storage::url($user->qrCode->first()->path)) }}">
                    </figure>
                @else
                    <article class="message is-warning">
                        <div class="message-body">
                            Aucun <strong>qr code</strong> n'est généré pour {{ $user->fullname }}, 
                            la connexion a l'app mobile n'est donc pas possible.
                            @can('create', App\User::class)
                                <strong>Vous pouvez en <a href="{{ route('users.create') }}">générer un</a>.</strong>
                            @endcan
                        </div>
                    </article>
                @endif
            </div>

            {{-- User infos --}}
            <div class="column is-8">
                <div class="columns">
                    <div class="column is-4">
                        <figure class="image">
                            <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                        </figure>
                    </div>
                    <div class="column is-3 has-text-right">
                        <strong>
                            Nom complet :<br>
                            Nom d'utilisateur :<br>
                            Adresse email :<br>
                            Téléphone :<br>
                            Sexe :<br>
                        </strong>
                    </div>
                    <div class="column is-5">
                        <p>
                            {{ $user->fullname }}<br>
                            {{ $user->name }}<br>
                            {{ $user->email }}<br>
                            {{ $user->phone_number }}<br>
                            {{ $user->sex }}<br>
                        </p>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-4">
                        <figure class="image">
                            <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                        </figure>
                    </div>
                    <div class="column is-3 has-text-right">
                        <strong>
                            Groupes :<br>
                            Role :<br>
                            Status actuel :<br>
                        </strong>
                    </div>
                    <div class="column is-5">
                        <p>
                            @foreach ($user->groups as $group)
                                <span class="tag is-light">
                                    {{ $group->name }}
                                </span>
                            @endforeach
                            <br>
                            {{ $user->roles->first()->name }}<br>
                            {{ $user->status }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-4">
                <h2 class="title is-3">Derniers runs</h2>
            </div>
    
            <div class="column is-8">
                <h2 class="title is-3">Commentaires</h2>
            </div>
        </div>

        <div class="columns">
            <div class="column is-4">
                tutu
            </div>

            <div class="column is-8">

                <div class="columns">
                    <div class="column is-12">
                        @if ($user->comments()->exists())
                            @foreach ($user->comments as $comment)
                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-64x64">
                                            <img src="https://bulma.io/images/placeholders/128x128.png">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                                                <br>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
                                            </p>
                                    </div>
                                    <nav class="level is-mobile">
                                        <div class="level-left">
                                            <a class="level-item">
                                                <span class="icon is-small"><i class="fas fa-reply"></i></span>
                                            </a>
                                            <a class="level-item">
                                                <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                                            </a>
                                            <a class="level-item">
                                                <span class="icon is-small"><i class="fas fa-heart"></i></span>
                                            </a>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="media-right">
                                        <button class="delete"></button>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <p>Aucun commentaires</p>
                        @endif
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-12">
                        <form action="{{ route('users.comments.store', ['user' => $user->id]) }}" method="POST">
                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-64x64">
                                        <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="field">
                                        <p class="control">
                                            <textarea class="textarea" placeholder="Add a comment..."></textarea>
                                        </p>
                                    </div>
                                    <nav class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <a class="button is-info">Submit</a>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </article>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection