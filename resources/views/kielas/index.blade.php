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
                                    
                                    @foreach ($groups as $group)
                                        @foreach ($group->schedules->where('start_time', '>=', $now)->unique() as $present)
                                            
                                            Groupe {{$group->name}}
                                            @component('components/status_tag', ['status' => 'free'])
                                            @endcomponent<br><hr>
                                    
                                        @endforeach
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
                                    @foreach ($users as $user)
                                        
                                        @if ($user->status == 'free')
                                            {{$user->firstname}} {{$user->lastname}}

                                            @component('components/status_tag', ['status' => $user->status])
                                            @endcomponent
                                            <br><hr>

                                        @endif

                                        @if ($user->status == 'gone')

                                            {{$user->firstname}} {{$user->lastname}}
                                            @component('components/status_tag', ['status' => 'taken'])
                                            @endcomponent
                                            <br><hr>

                                        @endif
                                        @if ($user->status == 'not-present' || $user->status == 'not-requested')

                                            {{$user->firstname}} {{$user->lastname}}
                                            @component('components/status_tag', ['status' => 'hors_service'])
                                            @endcomponent
                                            <br><hr>

                                        @endif


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

                                             {{$car->model}} {{$car->plate_number}}
                                            @component('components/status_tag', ['status' => $car->status])
                                            @endcomponent
                                            <br><hr>

                                        @elseif ($car->status == 'taken')

                                            {{$car->model}} {{$car->plate_number}}
                                            @component('components/status_tag', ['status' => $car->status])
                                            @endcomponent
                                            <br><hr>

                                        @else

                                            {{$car->model}} {{$car->plate_number}}
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
