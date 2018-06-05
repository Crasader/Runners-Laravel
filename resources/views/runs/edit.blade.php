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
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $run)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-run-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </p>
                    @endcan
                    @can('delete', $run)
                        <p class="control">
                            <form id="delete-run-form"
                                action="{{ route('runs.destroy', ['run' => $run->id]) }}"
                                method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-run-form').submit();"
                                class="button is-danger">
                                Supprimer {{ $run->name }}
                            </button>
                        </p>
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
                            <label class="label">Nom / Artiste</label>
                        </div>
                        <div class="field-body">

                            {{-- RUN NAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => 'Nom du run',
                                'type'        => 'text',
                                'icon'        => 'fa-bookmark',
                                'value'       => $run->name,
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Par défault, le nom de l'artiste sera utilisé.
                                </p>
                            @endcomponent

                            {{-- ARTIST --}}
                            {{-- SEARCH FIELD --}}
                            @component('components/horizontal_search_input', [
                                'name'        => 'artist',
                                'placeholder' => 'Artiste',
                                'type'        => 'text',
                                'icon'        => 'fa-search',
                                'value'       => $run->artists->first()->name,
                                'searchUrl'   => route('artists.search'),
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Si inéxistant, il sera ajouté a la base de données.
                                </p>
                            @endcomponent

                        </div>
                    </div>

                    <h2 class="title is-4">Lieux de passage</h3>

                    {{-- WAYPOINTS --}}

                    @foreach($run->waypoints as $waypoint)

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                @if($loop->first)
                                    <label class="label">Départ</label>
                                @elseif($loop->last)
                                    <label class="label">Arrivée</label>
                                @else
                                    <label class="label">Lieux {{ $waypoint->pivot->order }}</label>
                                @endif
                            </div>
                            <div class="field-body">

                                {{-- WAYPOINT --}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "waypoints[{$waypoint->pivot->order}]",
                                    'placeholder' => 'Lieux de départ',
                                    'type'        => 'text',
                                    'icon'        => 'fa-map-signs',
                                    'value'       => $waypoint->name,
                                    'searchUrl'   => route('waypoints.search'),
                                    'errors'      => $errors
                                    ])
                                    @slot('button')
                                        <button type="submit" name="addWaypoint" value="{{ $waypoint->pivot->order }}" class="button is-info">
                                            <span class="icon">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </button>
                                    @endslot
                                @endcomponent

                            </div>
                        </div>

                    @endforeach

                    <h2 class="title is-4">Horaires</h3>

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
                                'value'       => $run->planned_at->format('Y-m-d\\TH:i:s')
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Fin prévue a :</label>
                        </div>
                        <div class="field-body">

                            {{-- END TIME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'end_planned_at',
                                'placeholder' => "Véhicule",
                                'type'        => 'datetime-local',
                                'icon'        => 'fa-clock',
                                'errors'      => $errors,
                                'value'       => $run->end_planned_at->format('Y-m-d\\TH:i:s')
                                ])
                            @endcomponent

                        </div>
                    </div>

                    @foreach($run->subscriptions as $subscription)

                        <h2 class="title is-4">Runner {{ $loop->index + 1 }}</h3>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Runner</label>
                            </div>
                            <div class="field-body">

                                {{-- Runner--}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "subscriptions[{$subscription->id}][user]",
                                    'placeholder' => 'Conducteur',
                                    'type'        => 'text',
                                    'icon'        => 'fa-user',
                                    'value'       => $subscription->user->name,
                                    'searchUrl'   => route('users.search'),
                                    'errors'      => $errors
                                    ])
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
                                    'placeholder' => 'Type de véhicule',
                                    'type'        => 'text',
                                    'icon'        => 'fa-truck',
                                    'value'       => $subscription->carType->name,
                                    'searchUrl'   => route('carTypes.search'),
                                    'errors'      => $errors
                                    ])
                                @endcomponent

                                {{-- CAR --}}
                                {{-- SEARCH FIELD --}}
                                @component('components/horizontal_search_input', [
                                    'name'        => "subscriptions[{$subscription->id}][car]",
                                    'placeholder' => 'Véhicule',
                                    'type'        => 'text',
                                    'icon'        => 'fa-car',
                                    'value'       => $subscription->car->name,
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