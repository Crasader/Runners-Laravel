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

@section('content')

<div class="section">
    <div class="container">

        {{-- TITLE AND ACTIONS --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    Run {{ $run->name }}
                    @component('components/status_tag', ['status' => $run->status])
                        is-medium
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $run)
                        <div class="control">
                            @component('components/runs/run_action_buttons', [
                                'status' => $run->status,
                                'id' => $run->id,
                                'run' => $run
                                ])
                            @endcomponent
                        </div>
                        <p class="control">
                            <a href="{{ route('runs.edit', ['run' => $run->id]) }}" class="button is-info">Modifier le run</a>
                        </p>
                    @endcan
                    <p class="control">
                        <a href="{{ route('runs.print', ['run' => $run->id]) }}" class="button is-info">Imprimer</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- RUN INFOS --}}
        <div class="columns">
            <div class="column">
                <h2 class="title is-4">Horaires</h2>
            </div>
            <div class="column">
                <h2 class="title is-4">Départ -> arrivée</h2>
            </div>
            <div class="column is-5">
                <h2 class="title is-4">Infos</h2>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="content box">
                    @datetag(['date' => $run->planned_at])
                        Prévu le
                    @enddatetag
                    @datetag(['date' => $run->started_at])
                        Démarré le
                    @enddatetag
                    @datetag(['date' => $run->ended_at])
                        Terminé
                    @enddatetag
                </div>
            </div>

            <div class="column">
                @component('components/runs/run_waypoints_box', ['waypoints' => $run->waypoints()->orderBy('pivot_order')->get()])
                @endcomponent
            </div>

            <div class="column is-5">
                <div class="content box">
                    <p>
                        <strong>
                            @if(empty($run->passengers))
                                0
                            @else
                                {{ $run->passengers }}
                            @endif
                        </strong>
                        passagers
                    </p>
                    <p>
                        <strong>
                            Informations :
                        </strong>
                        {{ $run->infos }}
                    </p>
                </div>
            </div>
        </div>

        {{-- RUN INFOS --}}
        <div class="columns">
            <div class="column">
                <h2 class="title is-4">Runners</h2>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                @component('components/runs/run_runners_box', ['subscriptions' => $run->subscriptions])
                @endcomponent
            </div>
        </div>

        @foldable(['folded' => true, 'id' => 'more-infos-zone'])
            @slot('foldedTitle')
                <div class="columns">
                    <div class="column is-12">
                        <h2 class="title is-4">
                            Plus d'infos...
                        </h2>
                    </div>
                </div>
            @endslot
            @slot('unFoldedTitle')
                <div class="columns">
                    <div class="column is-12">
                        <h2 class="title is-4">Plus d'infos (masquer)</h2>
                    </div>
                </div>
            @endslot
            <div class="columns">
                <div class="column is-5">
                    <h2 class="title is-4">Logs</h2>
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
                                    <th>
                                        @datetext(['date' => $log->created_at])
                                        @enddatetext
                                    </th>
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
                                                        document.getElementById('delete-comment-form-{{ $comment->id }}').submit();"
                                                        class="delete">
                                                    </button>
                                                    <form id="delete-comment-form-{{ $comment->id }}"
                                                        action="{{ route('runs.comments.destroy', ['run' => $run->id, 'comment' => $comment->id]) }}"
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
                    <div class="column is-7">
                        <p>Vous ne pouvez pas voir les commentaires</p>
                    </div>
                @endcan
            </div>
        @endfoldable
    </div>
</div>

@endsection