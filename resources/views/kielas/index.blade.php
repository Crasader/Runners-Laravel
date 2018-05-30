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
                    <h1 class="title is-2">{{$festival->name}}</h1>
                    <b>Il est actuellement le : {{$now}}</b>
                </div>
                <div class="column is-4">
                    <!-- Add new user to kiela -->
                    <a href="{{ route('kiela.create') }}" class="button is-info is-pulled-right">Ajouter un chauffeur</a>
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
                <div class="column is-4">
                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <div class="title is-3">Groupes<hr></div>
                                    <!-- Get groups -->
                                    @foreach ($present as $schedule)
                                        <a href="{{ route('groups.show', ['group' => $schedule->group->id]) }}"><span class="tag is-large" style="background-color: #{{ $schedule->group->color }};">{{ $schedule->group->name }}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="column is-4">
                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <div class="title is-3">Chauffeurs<hr></div>
                                    <!-- Get user -->
                                    @foreach ($present as $schedule)
                                        @foreach ($schedule->group->users as $user)
                                                <a href="{{ route('users.show', ['user' => $user->id]) }}">{{$user->firstname}} {{$user->lastname}}</a>
                                                @component('components/status_tag', ['status' => $user->status])
                                                @endcomponent
                                                <br><hr>
                                        @endforeach
                                    @endforeach

                                    <div class="title is-4">Chauffeurs ajouté à la main<hr></div>
                                    <!-- Get user added -->
                                    @foreach ($presentKiela as $schedule)
                                        <a href="{{ route('users.show', ['user' => $schedule->user->id]) }}">{{$schedule->user->firstname}} {{$schedule->user->lastname}}</a>
                                        @component('components/status_tag', ['status' => $schedule->user->status])
                                        @endcomponent
                                        <br><hr>
                                    @endforeach

                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="column is-4">
                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <div class="title is-3">Véhicules<hr></div>
                                    <!-- Get cars status -->
                                    @foreach ($cars as $car)
                                        @if ($car->status == 'free')
                                            <a href="{{ route('cars.show', ['car' => $car->id]) }}">{{$car->model}} {{$car->plate_number}}</a>
                                            @component('components/status_tag', ['status' => $car->status])
                                            @endcomponent
                                            <br><hr>
                                        @elseif ($car->status == 'taken')
                                            <a href="{{ route('cars.show', ['car' => $car->id]) }}">{{$car->model}} {{$car->plate_number}}</a>
                                            @component('components/status_tag', ['status' => $car->status])
                                            @endcomponent
                                            <br><hr>
                                        @else
                                            <a href="{{ route('cars.show', ['car' => $car->id]) }}">{{$car->model}} {{$car->plate_number}}</a>
                                            @component('components/status_tag', ['status' => $car->status])
                                            @endcomponent
                                            <br><hr>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
