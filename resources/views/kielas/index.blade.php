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
                                    <span class="title is-4">Groupes présents : </span>
                                    <!-- Get groups -->
                                    @foreach ($present as $schedule)
                                        <a href="{{ route('groups.show', ['group' => $schedule->group->id]) }}"><span class="tag is-large" style="background-color: #{{ $schedule->group->color }};">{{ $schedule->group->name }}</span>
                                            @timetag(['date' => $schedule->start_time])
                                            @endtimetag
                                            -
                                            @timetag(['date' => $schedule->end_time])
                                            @endtimetag
                                        </a>
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
                            <div class="column is-12">
                                <p class="title is-4">
                                    Chauffeurs présents :
                                </p>
                            </div>
                            @foreach ($present as $schedule)
                                @foreach ($schedule->group->users as $user)
                                    <div class="column is-2">
                                        <figure class="image">
                                            <img src="{{ asset(Storage::url($user->profilePictures->first()->path)) }}">
                                        </figure>
                                        <p class="has-text-centered has-margin-top-10">
                                            <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                        <span class="tag is-medium" style="background-color: #{{ $schedule->group->color }};">
                                            {{$user->name}}
                                        </span>
                                            </a>
                                        </p>
                                        <p class="has-text-centered">
                                            <span class="is-bold">
                                                {{$user->phone_number}}
                                            </span>
                                        </p>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                @if ($presentKiela->count() > 0)
                    <div class="column is-2">
                        <div class="box">
                            <div class="columns is-multiline">
                                <div class="column is-12"><p class="title is-4">Chauffeurs rajoutés :</p></div>
                                @foreach ($presentKiela as $schedule)
                                    <div class="column is-12">
                                        {{-- Get user --}}
                                        <img src="{{ asset(Storage::url($schedule->user->profilePictures->last()->path)) }}" width="100%">
                                        <p class="has-text-centered has-margin-top-10">
                                            <a href="{{ route('users.show', ['user' => $schedule->user->id]) }}">
                                                <span class="tag is-medium" style="background-color: #{{ $schedule->user->groups->first()->color }}; text-align:center;">
                                                    {{$schedule->user->name}}
                                                </span>
                                            </a>
                                            @can('delete', $schedule)
                                                <button onclick="event.preventDefault();
                                                    document.getElementById('delete-kiela-user-{{ $schedule->id }}').submit();"
                                                    class="delete">
                                                </button>
                                                <form id="delete-kiela-user-{{ $schedule->id }}"
                                                    action="{{ route('kiela.destroy', ['kiela' => $schedule->id]) }}"
                                                    method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endcan
                                        </p>
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
