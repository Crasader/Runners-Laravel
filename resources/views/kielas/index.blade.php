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
                <div class="column is-12">
                    <h1 class="title is-2">Kiéla?</h1>
                    <div class="column is-4">
                        <a href="{{ route('cars.create') }}" class="button is-info is-pulled-right">Ajouter un chauffeur</a>
                    </div>
                    <h2 class="title is-3">{{$festival->name}}</h2>
                    <b>Il est {{$now->format('H:i')}}</b>
                </div>
            </div>
            <div class="columns">
                <div class="column is-4">
                    <div class="title is-3">Groupes</div>

                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    @foreach ($present as $schedule)
                                        <a href="{{ route('groups.show', ['group' => $schedule->group->id]) }}"><span class="tag is-large" style="background-color: #{{ $schedule->group->color }};">{{ $schedule->group->name }}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    </div>

                </div>

                <div class="column is-4">
                    <div class="title is-3">Chauffeurs</div>

                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    @foreach ($present as $schedule)
                                        @foreach ($schedule->group->users as $user)
                                        
                                                <a href="{{ route('users.show', ['user' => $user->id]) }}">{{$user->firstname}} {{$user->lastname}}</a>

                                                @component('components/status_tag', ['status' => $user->status])
                                                @endcomponent
                                                <br><hr>
                                                
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    </div>
                    
                </div>

                <div class="column is-4">
                    <div class="title is-3">Véhicules</div>

                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
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
