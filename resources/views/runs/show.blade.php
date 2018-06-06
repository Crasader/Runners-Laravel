{{--
  -- Runs edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('runs.index') }}">Runs</a></li>
<li><a href="{{ route('runs.show', ['run' => $run->id]) }}">{{ $run->name }}</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/runs/create.js') }}"></script>
@endpush

@section('content')

<div class="section">
    <div class="container">

        {{-- TITLE AND ACTIONS --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    Edition du run {{ $run->name }}
                    @component('components/status_tag', ['status' => $run->status])
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $run)
                        <p class="control">
                            <a href="{{ route('runs.edit', ['run' => $run->id]) }}" class="button is-info">Modifier le run</a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        {{-- RUN INFOS --}}
        <div class="columns">
            <div class="column is-3">
                <h2 class="title is-4">Horaires</h2>
            </div>
            <div class="column is-3">
                <h2 class="title is-4">Depart -> arrivée</h2>
            </div>
            <div class="column is-6">
                <h2 class="title is-4">Runners</h2>
            </div>
        </div>

        <div class="columns">
            <div class="column is-3">
                <div class="content">
                    <p>
                        Prévu le
                        <span class="tag">
                            <strong>
                                {{ $run->planned_at->format('l d') }}
                            </strong>
                        </span>
                        à
                        <span class="tag">
                            <strong>
                                {{ $run->planned_at->format('H \h m') }}
                            </strong>
                        </span>
                    </p>

                    <p>
                        Démarré le
                        <span class="tag">
                            <strong>
                                {{ $run->started_at->format('l d') }}
                            </strong>
                        </span>
                        à
                        <span class="tag">
                            <strong>
                                {{ $run->started_at->format('H \h m') }}
                            </strong>
                        </span>
                    </p>

                    <p>
                        Terminé le
                        <span class="tag">
                            <strong>
                                {{ $run->ended_at->format('l d') }}
                            </strong>
                        </span>
                        à
                        <span class="tag">
                            <strong>
                                {{ $run->ended_at->format('H \h m') }}
                            </strong>
                        </span>
                    </p>
                </div>
            </div>

            <div class="column is-3">
                @component('components/runs/run_waypoints_box', ['waypoints' => $run->waypoints])
                @endcomponent
            </div>

            <div class="column is-6">
                @component('components/runs/run_runners_box', ['subscriptions' => $run->subscriptions])
                @endcomponent
            </div>
        </div>

        {{-- LOGS AND COMMENTS --}}
        <div class="columns">
            <div class="column is-5">
                <h2 class="title is-4">Dernières actions effectuées sur ce run</h2>
            </div>
            <div class="column is-7">
                <h2 class="title is-4">Commentaires</h2>
            </div>
        </div>

        <div class="columns">

            {{-- Logs --}}
            <div class="column is-5">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Effectué par</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($run->logs()->orderBy('created_at', 'desc')->limit(10)->get() as $log)
                            <tr>
                                <th>{{ $log->created_at->format('d-m-Y H:i:s') }}</th>
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

            @can('view', App\Comment::class)
                <div class="column is-7">

                    {{-- --------------------- --}}
                    {{-- COMMENTS LISTING      --}}
                    {{-- --------------------- --}}
                    <div class="columns">
                        <div class="column is-12">
                            @if ($run->comments()->exists())
                                @foreach ($run->comments as $comment)
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
                                                    action="{{ route('users.comments.destroy', ['run' => $run->id, 'comment' => $comment->id]) }}"
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
                                <form action="{{ route('runs.comments.store', ['run' => $run->id]) }}" method="POST">
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