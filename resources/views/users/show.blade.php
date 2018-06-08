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
                            <a href="{{ route('users.generate-credentials', ['user' => $user->id]) }}" class="button is-warning">Générer identifiants</a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>


        {{-- --------------------- --}}
        {{-- TITLES                --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-5">
                <h2 class="title is-3">QR code</h2>
            </div>
            <div class="column is-7">
                <h2 class="title is-3">Informations</h2>
            </div>
        </div>

        {{-- --------------------- --}}
        {{-- QR code infos         --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-5">
                @if ($user->qrCodes()->exists())
                    <figure class="image box">
                        <img src="{{ asset(Storage::url($user->qrCodes->first()->path)) }}">
                    </figure>
                    <article class="message is-info">
                        <div class="message-body">
                            Vous pouvez utiliser ce QR code pour vous connecter a l'app mobile.
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
                            la connexion à l'app mobile n'est donc pas possible.
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
            <div class="column is-7">
                <div class="columns">
                    <div class="column is-4">
                        <figure class="image box">
                            <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                        </figure>
                    </div>
                    <div class="column is-8">
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Nom complet : </strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    {{ $user->fullname }}
                                </p>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Adresse email :</strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Téléphone : </strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    {{ $user->phone_number }}
                                </p>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Sexe : </strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    {{ $user->sex }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-4">
                        <figure class="image box">
                            <img src="{{ asset(Storage::url($user->licencePictures->first()->path)) }}">
                        </figure>
                    </div>
                    <div class="column is-8">
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Groupe : </strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    @foreach ($user->groups as $group)
                                        <span class="tag" style="background-color: #{{ $group->color }};">
                                            {{ $group->name }}
                                        </span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Rôle : </strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    {{ $user->roles->first()->name }}
                                </p>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-4 has-text-right">
                                <p>
                                    <strong>Status actuel : </strong>
                                </p>
                            </div>
                            <div class="column is-8">
                                <p>
                                    @statustag(['status' => $user->status])
                                    @endstatustag
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-6">
                <h2 class="title is-3">Runs</h2>
            </div>

            <div class="column is-6">
                <h2 class="title is-3">Commentaires</h2>
            </div>
        </div>

        <div class="columns">
            <div class="column is-6">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Status</th>
                            <th>Départ prévu le</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Status</th>
                            <th>Départ prévu le</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($user->runs()->orderBy('planned_at')->get() as $run)
                            <tr onclick="window.location.href = '{{ route('runs.show', ['run' => $run->id]) }}'">
                                <th>{{ $run->name }}</th>
                                {{-- Display a tag with the group background color --}}
                                <th>
                                    {{-- Status tag (see related component) --}}
                                    @component('components/status_tag', ['status' => $run->status])
                                    @endcomponent
                                </th>
                                <td>
                                    @datetag(['date' => $run->planned_at])
                                    @enddatetag
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="tag is-warning is-medium">
                                        <strong>Ce chauffeur n'effectue aucun run<strong>
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            @can('view', App\Comment::class)
                <div class="column is-6">


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

        {{-- LOGS --}}
        @can('view', App\Log::class)
            <div class="columns">
                <div class="column">
                    <h2 class="title is-3">Logs</h2>
                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    <h2 class="title is-5">Dernières actions effectuées par cet utilisateur</h2>
                </div>

                <div class="column is-6">
                    <h2 class="title is-5">Dernières actions effectuées sur cet utilisateur</h2>
                </div>
            </div>

            {{-- Logs fired by this user --}}
            <div class="columns">
                <div class="column is-6">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Ressource</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->myLogs()->orderBy('created_at', 'desc')->limit(10)->get() as $log)
                                <tr>
                                    <td>
                                        @datetext(['date' => $log->created_at])
                                        @enddatetext
                                    </td>
                                    <td>
                                        {{-- Status tag (see related component) --}}
                                        @logaction(['action' => $log->action])
                                        @endlogaction
                                    </td>
                                    <td>
                                        {{ $log->loggable_type }}
                                        <span class="tag is-light">{{ $log->loggable_id }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Logs fired on this user --}}
                <div class="column is-6">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Effectué par</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->logs()->orderBy('created_at', 'desc')->limit(10)->get() as $log)
                                <tr>
                                    <td>
                                        @datetext(['date' => $log->created_at])
                                        @enddatetext
                                    </td>
                                    <td>
                                        {{-- Status tag (see related component) --}}
                                        @logaction(['action' => $log->action])
                                        @endlogaction
                                    </td>
                                    @if($log->user()->count())
                                        <td>
                                            <a href="{{ route('users.show', ['user' => $log->user->id]) }}">
                                                {{ $log->user->fullname }}
                                            </a>
                                        </td>
                                    @else
                                        <td>Migrations</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan

    </div>
</div>

@endsection