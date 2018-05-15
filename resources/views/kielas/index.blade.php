{{--
  -- Cars index
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
                    {{$festival->name}}
                    {{$now}}
                </div>
            </div>
            <div class="columns">
                <div class="column is-4">
                    <div class="title is-3">Groupes</div>

                    <div class="box">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <div class="title is-4">Présents :<hr></div>
                                    @foreach ($groups as $group)
                                    
                                        {{$group->name}}<br>
                                    @endforeach
                                    <hr>
                                    <div class="title is-4">Hors service :<hr></div>
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
                                    <div class="title is-4">Présents :<hr></div>
                                    @foreach ($users as $user)

                                        @if ($user->status == 'free')
                                            {{$user->firstname}} - {{$user->status}}<br>
                                        @elseif ($user->status == 'gone')
                                            {{$user->firstname}} - {{$user->status}}<br>
                                        @elseif ($user->status == 'not-present' || $user->status == 'not-requested')
                                            {{$user->firstname}} - {{$user->status}}<br>
                                        @endif


                                    @endforeach
                                    <hr>
                                    <div class="title is-4">En run :<hr></div>
                                    <div class="title is-4">Hors service :<hr></div>
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
                                    <div class="title is-4">Présents :<hr></div>
                                    @foreach ($cars as $car)

                                        @if ($car->status == 'free')
                                            {{$car->plate_number}} - {{$car->status}}<br> 
                                        @elseif ($car->status == 'taken')
                                            {{$car->plate_number}} - {{$car->status}}<br>
                                        @else
                                            {{$car->plate_number}} - {{$car->status}}<br>
                                        @endif
                                        
                                    @endforeach
                                    <hr>
                                    <div class="title is-4">En run :<hr></div>
                                    <div class="title is-4">Hors service :<hr></div>
                                    <div class="title is-4">Problèmes :<hr></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection
