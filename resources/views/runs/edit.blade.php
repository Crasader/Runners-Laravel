{{--
  -- Runs edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('runs.index') }}">Runs</a></li>
<li><a href="{{ route('runs.show', ['run' => $run->id]) }}">{{ $run->name }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/runs/create.js') }}"></script>
@endpush

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    Edition du run {{ $run->name }}
                    @component('components/status_tag', ['status' => $run->status])
                        is-medium
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $run)
                        <div class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-run-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </div>
                    @endcan
                    @can('delete', $run)
                        <div class="control">
                            <form id="delete-run-form"
                                action="{{ route('runs.destroy', ['run' => $run->id]) }}"
                                method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-run-form').submit();"
                                class="button is-danger">
                                Supprimer le run
                            </button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="update-run-form" action="{{ route('runs.update', ['run' => $run->id]) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <h2 class="title is-4">Informations générales</h3>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Artiste : </label>
                        </div>
                        <div class="field-body">

                            {{-- ARTIST --}}
                            {{-- SEARCH FIELD --}}
                            @component('components/horizontal_search_input', [
                                'name'        => 'artist',
                                'placeholder' => 'Artiste',
                                'type'        => 'text',
                                'icon'        => 'fa-search',
                                'value'       => $run->artists()->exists() ? $run->artists->first()->name : '',
                                'searchUrl'   => route('artists.search'),
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Si inexistant, il sera ajouté a la base de données.
                                </p>
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Passagers :</label>
                        </div>
                        <div class="field-body">

                            {{-- Nombre de passagers --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'passengers',
                                'placeholder' => "Nombre de passagers",
                                'type'        => 'text',
                                'icon'        => 'fa-users',
                                'errors'      => $errors,
                                'value'       => $run->passengers
                                ])
                            @endcomponent

                        </div>
                    </div>

                    {{-- PLANNED AT --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Début prévu à :</label>
                        </div>
                        <div class="field-body">

                            {{-- START TIME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'planned_at',
                                'placeholder' => "Type de véhicule",
                                'type'        => 'datetime-local',
                                'icon'        => 'fa-clock',
                                'errors'      => $errors,
                                'value'       => $run->planned_at ? $run->planned_at->format('Y-m-d\\TH:i:s') : now()->startOfHour()->format('Y-m-d\\TH:i:s')
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Informations</label>
                        </div>
                        <div class="field-body">

                            {{-- RUN INFOS --}}
                            <div class="field">
                                <p class="control">
                                    <textarea
                                        class="textarea {{ $errors->has('infos') ? ' is-danger' : '' }}"
                                        name="infos"
                                        placeholder="Informations liées au run, choses à prendre..."
                                        >{{ old('infos') ? old('infos') : $run->infos }}</textarea>
                                </p>
                                @if ($errors->has('infos'))
                                    <p class="help is-danger">{{ $errors->first('infos') }}</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <h2 class="title is-4">Lieux de passage</h3>

                    @if ($errors->has('waypoints'))
                        <article class="message is-danger">
                            <div class="message-body">
                                {{ $errors->first('waypoints') }}
                            </div>
                        </article>
                    @endif

                    {{-- WAYPOINTS --}}

                    @foreach($run->waypoints()->orderBy('pivot_order')->get() as $waypoint)

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                @if($loop->first)
                                    <label class="label">Départ</label>
                                @elseif($loop->last)
                                    <label class="label">Arrivée</label>
                                @else
                                    <label class="label">Lieu {{ $waypoint->pivot->order }}</label>
                                @endif
                            </div>
                            <div class="field-body">

                                {{-- WAYPOINT --}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "waypoints[{$waypoint->pivot->order}]",
                                    'errorName'   => "waypoints.{$waypoint->pivot->order}",
                                    'placeholder' => $waypoint->positionToString(),
                                    'type'        => 'text',
                                    'icon'        => 'fa-map-signs',
                                    'value'       => $waypoint->name,
                                    'searchUrl'   => route('waypoints.search'),
                                    'errors'      => $errors
                                    ])
                                    @slot('button')
                                        {{-- Button to remove waypoints --}}
                                        @unless ($loop->first)
                                            <button
                                                type="submit"
                                                name="remove-waypoint"
                                                value="{{ $waypoint->pivot->order }}"
                                                class="button is-danger">
                                                <span class="icon">
                                                    <i class="fas fa-minus"></i>
                                                </span>
                                            </button>
                                        @endunless
                                        {{-- Button to add waypoint after current waypoint --}}
                                        <button
                                            type="submit"
                                            name="add-waypoint"
                                            value="{{ $waypoint->pivot->order }}"
                                            class="button is-info">
                                            <span class="icon">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </button>
                                    @endslot
                                @endcomponent

                            </div>
                        </div>

                    @endforeach

                    <h2 class="title is-4">Runners</h3>

                    @foreach($run->subscriptions as $subscription)

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Runner {{ $loop->index + 1 }}</label>
                            </div>
                            <div class="field-body">

                                {{-- Runner--}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "subscriptions[{$subscription->id}][user]",
                                    'errorName'   => "subscriptions.{$subscription->id}.user",
                                    'placeholder' => 'Conducteur',
                                    'type'        => 'text',
                                    'icon'        => 'fa-user',
                                    'value'       => $subscription->user()->exists() ? $subscription->user->name : '',
                                    'searchUrl'   => route('users.search'),
                                    'errors'      => $errors
                                    ])
                                    @slot('button')
                                        <button
                                            type="submit"
                                            name="remove-runner"
                                            value="{{ $subscription->id }}"
                                            class="button is-danger">
                                            <span class="icon">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                        </button>
                                    @endslot
                                @endcomponent

                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Véhicule</label>
                            </div>
                            <div class="field-body">

                                {{-- CATYPE--}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "subscriptions[{$subscription->id}][carType]",
                                    'errorName'   => "subscriptions.{$subscription->id}.carType",
                                    'placeholder' => 'Type de véhicule',
                                    'type'        => 'text',
                                    'icon'        => 'fa-truck',
                                    'value'       => $subscription->carType()->exists() ? $subscription->carType->name : '',
                                    'searchUrl'   => route('carTypes.search'),
                                    'errors'      => $errors
                                    ])
                                @endcomponent

                                {{-- CAR --}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "subscriptions[{$subscription->id}][car]",
                                    'errorName'   => "subscriptions.{$subscription->id}.car",
                                    'placeholder' => 'Véhicule',
                                    'type'        => 'text',
                                    'icon'        => 'fa-car',
                                    'value'       => $subscription->car()->exists() ? $subscription->car->name : '',
                                    'searchUrl'   => route('cars.search'),
                                    'errors'      => $errors
                                    ])
                                @endcomponent

                            </div>
                        </div>

                    @endforeach

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                        </div>
                        <div class="field-body">

                            {{-- SEX --}}
                            <div class="field is-pulled-right">
                                <p class="control">
                                    <button type="submit" name="add-runner" value="true" class="button is-info">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span>Ajouter un runner</span>
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection