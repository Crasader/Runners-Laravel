{{--
  -- Kiela index
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
    <li class="is-active"><a href="#" aria-current="page">Kiéla?</a></li>
@endsection

@section('content')

    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-8">
                    <!-- Show current paleo and hour -->
                    <h1 class="title is-2">
                        @datetext(['date' => $now])
                        @enddatetext
                    </h1>
                    <b><u>{{$festival->name}}</u></b>
                </div>
                <div class="column is-4">
                    @can('create', App\Kiela::class)
                        <!-- Add new user to kiela -->
                        <a href="{{ route('kiela.create') }}" class="button is-info is-pulled-right">Ajouter un chauffeur</a>
                    @endcan
                </div>

            </div>
            <div class="columns">
                <div class="column is-8  is-offset-4">
                    <a href="{{ route('kiela.index') }}?date={{$now}}&hours=24&type=sub" class="button is-light"><span class="icon"><i class="fas fa-arrow-left"></i></span> <span>1 jour</span></a>
                    <a href="{{ route('kiela.index') }}?date={{$now}}&hours=1&type=sub" class="button is-light"><span class="icon"><i class="fas fa-arrow-left"></i></span> <span>1 heure</span></a>
                    <a href="{{ route('kiela.index') }}" class="button is-info">Maintenant</a>
                    <a href="{{ route('kiela.index') }}?date={{$now}}&hours=1&type=add" class="button is-light"><span>1 heure</span><span class="icon"><i class="fas fa-arrow-right"></i></span></a>
                    <a href="{{ route('kiela.index') }}?date={{$now}}&hours=24&type=add" class="button is-light"><span>1 jour</span><span class="icon"><i class="fas fa-arrow-right"></i></span></a>
                </div>
            </div>
            <div class="columns">
                <div class="column is-12">
                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <span class="title is-3">Groupes présents : </span>
                                    <!-- Get groups -->
                                    @foreach ($present as $schedule)
                                        <a href="{{ route('groups.show', ['group' => $schedule->group->id]) }}"><span class="tag is-large" style="background-color: #{{ $schedule->group->color }};">{{ $schedule->group->name }}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">

                    <div class="box">
                        <div class="columns is-multiline">
                            <div class="column is-12"><p class="title is-3">Chauffeurs présents :</p></div>
                            @foreach ($present as $schedule)
                                @foreach ($schedule->group->users as $user)
                                    <div class="column {{ $presentKiela->count() > 0 ? 'is-6' : 'is-4'}}">
                                        <article class="media">
                                            {{-- Get user --}}
                                            <figure class="media-left">
                                                <p class="image is-64x64">
                                                    <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                                                </p>
                                            </figure>
                                            <div class="media-content">
                                                <div class="content">
                                                    <p>
                                                        <a href="{{ route('users.show', ['user' => $user->id]) }}">{{$user->firstname}} {{$user->lastname}}</a>
                                                        @component('components/status_tag', ['status' => $user->status])
                                                        @endcomponent
                                                        <br>
                                                        @if ($user->runs->where('started_at', '<=', $now)->where('ended_at', '>=', $now)->first())
                                                            Run en cours : <a href="{{ route('runs.show', ['run' => $user->runs->first()->id])}}">{{$user->runs->first()->name}}</a>
                                                        @elseif ($user->runs->where('planned_at', '<=', $now)->where('end_planned_at', '>=', $now)->first() || $user->runs->where('started_at', '>=', $now)->first())
                                                            Prochain run : <a href="{{ route('runs.show', ['run' => $user->runs->first()->id])}}">{{$user->runs->first()->name}}</a> à {{$user->runs->first()->started_at != null ? $user->runs->first()->started_at->format('H:i') : $user->runs->first()->planned_at->format('H:i')}}
                                                        @else
                                                            Aucun run n'est attribué.
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                @if ($presentKiela->count() > 0)
                    <div class="column is-4">
                        <div class="box">
                            <div class="columns is-multiline">
                                    <div class="column is-12"><p class="title is-3">Chauffeurs rajoutés :</p></div>
                                @foreach ($presentKiela as $schedule)
                                    <div class="column is-12">
                                        <article class="media">
                                            {{-- Get user --}}
                                            <figure class="media-left">
                                                <p class="image is-64x64">
                                                    <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                                                </p>
                                            </figure>
                                            <div class="media-content">
                                                <div class="content">
                                                    <p>
                                                        <a href="{{ route('users.show', ['user' => $schedule->user->id]) }}">{{$schedule->user->firstname}} {{$schedule->user->lastname}}</a>
                                                        @component('components/status_tag', ['status' => $schedule->user->status])
                                                        @endcomponent
                                                        <br>
                                                        @if ($schedule->user->runs->where('started_at', '<=', $now)->where('ended_at', '>=', $now)->first())
                                                            Run en cours : <a href="{{ route('runs.show', ['run' => $schedule->user->runs->first()->id])}}">{{$schedule->user->runs->first()->name}}</a>
                                                        @elseif ($schedule->user->runs->where('planned_at', '<=', $now)->where('end_planned_at', '>=', $now)->first() || $schedule->user->runs->where('started_at', '>=', $now)->first())
                                                            Prochain run : <a href="{{ route('runs.show', ['run' => $schedule->user->runs->first()->id])}}">{{$schedule->user->runs->first()->name}}</a> à {{$schedule->user->runs->first()->started_at != null ? $schedule->user->runs->first()->started_at->format('H:i') : $schedule->user->runs->first()->planned_at->format('H:i')}}
                                                        @else
                                                            Aucun run n'est attribué.
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            @can('delete', $schedule)
                                                <div class="media-right">
                                                    <button onclick="event.preventDefault();
                                                        document.getElementById('delete-kiela-user-{{ $schedule->id }}').submit();"
                                                        class="delete"></button>
                                                    <form id="delete-kiela-user-{{ $schedule->id }}"
                                                        action="{{ route('kiela.destroy', ['kiela' => $schedule->id]) }}"
                                                            method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                </div>
                                            @endcan
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection
