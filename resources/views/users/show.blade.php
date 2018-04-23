{{--
  -- Show specified user
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Utilisateur</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $user->fullname }}</a></li>
@endsection
  
@section('content')

<div class="section">
    <div class="container">

        {{-- --------------------- --}}
        {{-- HEADER                --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    {{ $user->fullname }}
                    @component('components/status_tag', ['status' => $user->status])
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $user)
                        <p class="control">
                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="button is-info">Modifier l'utilisateur</a>
                        </p>
                    @endcan
                    @can('create', App\User::class)
                        <p class="control">
                            <a href="{{ route('users.generate-qr-code', ['user' => $user->id]) }}" class="button is-warning">Générer QR code</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('users.generate-credentials', ['user' => $user->id]) }}" class="button is-warning">Générer Identifiants</a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>


        {{-- --------------------- --}}
        {{-- TITLES                --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-4">
                <h2 class="title is-3">QR code</h2>
            </div>
            <div class="column is-8">
                <h2 class="title is-3">Informations</h2>
            </div>
        </div>

        {{-- --------------------- --}}
        {{-- QR code infos         --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-4">
                @if ($user->qrCode()->exists())
                    <figure class="image box">
                        <img src="{{ asset(Storage::url($user->qrCode->first()->path)) }}">
                    </figure>
                    <article class="message is-info">
                        <div class="message-body">
                            Vous pouvez utiliser ce QR code pour vous connecter a l'app mobile.
                        </div>
                    </article>
                @else
                    <article class="message is-warning">
                        <div class="message-body">
                            Aucun <strong>qr code</strong> n'est généré pour {{ $user->fullname }}, 
                            la connexion a l'app mobile n'est donc pas possible.
                            @can('create', App\User::class)
                                <strong>Vous pouvez en <a href="{{ route('users.generate-qr-code', ['user' => $user->id]) }}">générer un</a>.</strong>
                            @endcan
                        </div>
                    </article>
                @endif
            </div>

            {{-- --------------------- --}}
            {{-- USER INFOS            --}}
            {{-- --------------------- --}}
            <div class="column is-8">
                <div class="columns">
                    <div class="column is-4">
                        <figure class="image box">
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
                        <figure class="image box">
                            <img src="{{ asset(Storage::url($user->licencePictures->first()->path)) }}">
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


            @can('view', App\Comment::class)
                <div class="column is-8">


                    {{-- --------------------- --}}
                    {{-- COMMENTS LISTING      --}}
                    {{-- --------------------- --}}
                    <div class="columns">
                        <div class="column is-12">
                            @if ($user->comments()->exists())
                                @foreach ($user->comments as $comment)
                                    <article class="media">
                                        <figure class="media-left">
                                            <p class="image is-64x64">
                                                <img src="{{ asset(Storage::url($comment->author->profilePictures->first()->path)) }}">
                                            </p>
                                        </figure>
                                        <div class="media-content">
                                            <div class="content">
                                                <p>
                                                    <strong>{{ $comment->author->fullname }}</strong> <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                    <br>
                                                    {{ $comment->content }}
                                                </p>
                                            </div>
                                        </div>
                                        @can('delete', $comment)
                                            <div class="media-right">
                                                <button onclick="event.preventDefault();
                                                    document.getElementById('delete-comment-form').submit();"
                                                    class="delete"></button>
                                                <form id="delete-comment-form"
                                                    action="{{ route('users.comments.destroy', ['user' => $user->id, 'comment' => $comment->id]) }}"
                                                        method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        @endcan
                                    </article>
                                @endforeach
                            @else
                                <p>Aucun commentaires</p>
                            @endif
                        </div>
                    </div>


                    {{-- --------------------- --}}
                    {{-- COMMENT FORM          --}}
                    {{-- --------------------- --}}
                    @can('create', App\Comment::class)
                        <div class="columns">
                            <div class="column is-12">
                                <form action="{{ route('users.comments.store', ['user' => $user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <article class="media">
                                        <figure class="media-left">
                                            <p class="image is-64x64">
                                                <img src="{{ asset(Storage::url(Auth::user()->profilePictures->first()->path)) }}">
                                            </p>
                                        </figure>
                                        <div class="media-content">
                                            <div class="field">
                                                <p class="control">
                                                    <textarea class="textarea {{ $errors->has('content') ? ' is-danger' : '' }}" name="content" placeholder="Ajouter un commentaire..."></textarea>
                                                </p>
                                                @if ($errors->has('content'))
                                                    <p class="help is-danger">{{ $errors->first('content') }}</p>
                                                @endif
                                            </div>
                                            <nav class="level">
                                                <div class="level-left">
                                                    <div class="level-item">
                                                        <button type="submit" class="button is-info">Ajouter</button>
                                                    </div>
                                                </div>
                                            </nav>
                                        </div>
                                    </article>
                                </form>
                            </div>
                        </div>
                    @endcan

                </div>
            @else
                <div class="column is-8">
                    <p>Vous ne pouvez pas voir les commentaires</p>
                </div>
            @endcan

        </div>
    </div>
</div>

@endsection