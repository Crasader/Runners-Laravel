{{--
  -- Show specified user
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Utilisateur</a></li>
<li><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->fullname }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/users/edit.js') }}"></script>
@endpush

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
            {{-- Controls buttons on the top --}}
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $user)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-user-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </p>
                    @endcan
                    @unless($user->id === Auth::user()->id)
                        @can('delete', $user)
                            <p class="control">
                                <form id="delete-user-form"
                                    action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                    method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <button onclick="event.preventDefault();
                                    document.getElementById('delete-user-form').submit();"
                                    class="button is-danger">
                                    Supprimer {{ $user->fullname }}
                                </button>
                            </p>
                        @endcan
                    @endunless
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-narrow">
                <h2 class="title is-3">Information générales</h2>
            </div>
        </div>

        {{-- --------------------- --}}
        {{-- Edition fields        --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column">

                <form id="update-user-form" action="{{ route('users.update', ['user' => $user->id]) }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'lastname',
                                'placeholder' => 'Nom',
                                'value'       => $user->lastname,
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- FIRSTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'firstname',
                                'placeholder' => 'Prénom',
                                'value'       => $user->firstname,
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Coordonées</label>
                        </div>
                        <div class="field-body">

                            {{-- PHONE NUMBER --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'phone_number',
                                'placeholder' => "Numéro de téléphone",
                                'value'       => $user->phone_number,
                                'type'        => 'text',
                                'icon'        => 'fa-phone',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- EMAIL --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'email',
                                'placeholder' => "Adresse e-mail",
                                'value'       => $user->email,
                                'type'        => 'text',
                                'icon'        => 'fa-envelope',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Sexe</label>
                        </div>
                        <div class="field-body">

                            {{-- SEX --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="sex">
                                            <option value="m" {{ ($user->sex === 'm') ? 'selected' : '' }}>Homme</option>
                                            <option value="w" {{ ($user->sex === 'w') ? 'selected' : '' }}>Femme</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    @can('view', App\Role::class)
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Rôle</label>
                            </div>
                            <div class="field-body">

                                {{-- ROLE --}}
                                <div class="field is-narrow">
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="role">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->slug }}" {{ ($role->slug === $user->roles->first()->slug) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endcan

                </form>

            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">

        <div class="columns">
            <div class="column is-4">
                <h2 class="title is-3">QR code</h2>
            </div>
            <div class="column is-4">
                <h2 class="title is-3">Photo de profil</h2>
            </div>
            <div class="column is-4">
                <h2 class="title is-3">Permis</h2>
            </div>
        </div>


        <div class="columns">

            {{-- --------------------- --}}
            {{-- QR code managment     --}}
            {{-- --------------------- --}}
            <div class="column is-4">
                @if ($user->qrCodes()->exists())
                    <figure class="image box">
                        <img src="{{ asset(Storage::url($user->qrCodes->first()->path)) }}">
                    </figure>
                    <article class="message is-info">
                        <div class="message-body">
                            Vous pouvez utiliser ce QR code pour vous connecter à l'app mobile.
                        </div>
                    </article>
                    @can('update', $user)
                        <div class="field is-grouped">
                            <p class="control">
                                <a href="{{ route('users.generate-qr-code', ['user' => $user->id]) }}" class="button is-warning">Regénérer QR code</a>
                            </p>
                            <p class="control">
                                <a href="{{ route('users.delete-qr-code', ['user' => $user->id]) }}" class="button is-danger">Supprimer QR code</a>
                            </p>
                        </div>
                    @endcan
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
                    @can('create', App\User::class)
                        <a href="{{ route('users.generate-qr-code', ['user' => $user->id]) }}" class="button is-warning">Génerer QR code</a>
                    @endcan
                @endif
            </div>


            {{-- ------------------------- --}}
            {{-- Profile picture managment --}}
            {{-- ------------------------- --}}
            <div class="column is-4">
                @if ($user->profilePictures()->exists())
                    <figure class="image box">
                        <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                    </figure>
                @else
                    <article class="message is-warning">
                        <div class="message-body">
                            L'utilisateur le possède pas de photo de profil. Ajoutez en une.
                        </div>
                    </article>
                @endif
                @can('update', $user)
                    <form
                        action="{{ route('users.profile-picture.store', ['user' => $user->id]) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="field">
                            <div class="file has-name is-boxed {{ $errors->has('picture') ? ' is-danger' : '' }}">
                                <label class="file-label">
                                    <input id="user-picture-field" class="file-input" type="file" name="picture">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a file…
                                        </span>
                                    </span>
                                    <span id="user-picture-name" class="file-name">
                                        Aucun fichier
                                    </span>
                                </label>
                            </div>
                            @if ($errors->has('picture'))
                                <p class="help is-danger">{{ $errors->first('picture') }}</p>
                            @endif
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-success">Ajouter</button>
                            </div>
                            @if ($user->profilePictures()->exists())
                                <div class="control">
                                    <button onclick="event.preventDefault();
                                        document.getElementById('delete-user-picture-form').submit();"
                                        class="button is-danger">
                                        Supprimer
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                    @if ($user->profilePictures()->exists())
                        <form id="delete-user-picture-form"
                            method="POST"
                            action="{{ route('users.profile-picture.destroy', ['user' => $user->id, 'attachment' => $user->profilePictures->first()->id]) }}"
                            style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    @endif
                @endcan
            </div>


            {{-- -------------------------- --}}
            {{-- Liscence picture managment --}}
            {{-- -------------------------- --}}
            <div class="column is-4">
                @if ($user->licencePictures()->exists())
                    <figure class="image box">
                        <img src="{{ asset(Storage::url($user->licencePictures->first()->path)) }}">
                    </figure>
                @else
                    <article class="message is-warning">
                        <div class="message-body">
                            L'utilisateur le possède pas de photo de son permis. Ajoutez en une.
                        </div>
                    </article>
                @endif
                @can('update', $user)
                    <form
                        action="{{ route('users.licence-picture.store', ['user' => $user->id]) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="field">
                            <div class="file has-name is-boxed {{ $errors->has('picture') ? ' is-danger' : '' }}">
                                <label class="file-label">
                                    <input id="user-licence-field" class="file-input" type="file" name="picture">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a file…
                                        </span>
                                    </span>
                                    <span id="user-licence-name" class="file-name">
                                        Aucun fichier
                                    </span>
                                </label>
                            </div>
                            @if ($errors->has('picture'))
                                <p class="help is-danger">{{ $errors->first('picture') }}</p>
                            @endif
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-success">Ajouter</button>
                            </div>
                            @if ($user->licencePictures()->exists())
                                <div class="control">
                                    <button onclick="event.preventDefault();
                                        document.getElementById('delete-user-licence-form').submit();"
                                        class="button is-danger">
                                        Supprimer
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                    @if ($user->licencePictures()->exists())
                        <form id="delete-user-licence-form"
                            method="POST"
                            action="{{ route('users.licence-picture.destroy', ['user' => $user->id, 'attachment' => $user->licencePictures->first()->id]) }}"
                            style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    @endif
                @endcan
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <h2 class="title is-3">Commentaires</h2>
            </div>
        </div>

        <div class="columns">
            @can('view', App\Comment::class)
                <div class="column">


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
                                                    document.getElementById('delete-comment-form-{{ $comment->id }}').submit();"
                                                    class="delete"></button>
                                                <form id="delete-comment-form-{{ $comment->id }}"
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