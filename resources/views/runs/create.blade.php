{{--
  -- Runs creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('runs.index') }}">Runs</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouveau run</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/runs/create.js') }}"></script>
@endpush

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Nouveau run</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <a href="#" class="button is-success">Créer le run</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('runs.store') }}" method="POST">

                    {{ csrf_field() }}

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
                                'searchUrl'   => route('artists.search'),
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Si inéxistant, il sera ajouté a la base de données.
                                </p>
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Départ</label>
                        </div>
                        <div class="field-body">

                            {{-- WAYPOINT --}}
                            {{-- SEARCH FIELD --}}
                            @component('components/horizontal_search_input', [
                                'name'        => 'waypoint[1]',
                                'placeholder' => 'Lieux de départ',
                                'type'        => 'text',
                                'icon'        => 'fa-map-signs',
                                'searchUrl'   => route('waypoints.search'),
                                'errors'      => $errors
                                ])
                                @slot('button')
                                    <button id="add-waypoint-1" data-waypoint-index="1" class="button is-info">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </button>
                                @endslot
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Arrivée</label>
                        </div>
                        <div class="field-body">

                            {{-- WAYPOINT --}}
                            {{-- SEARCH FIELD --}}
                            @component('components/horizontal_search_input', [
                                'name'        => 'waypoint[2]',
                                'placeholder' => "Lieux d'arrivée",
                                'type'        => 'text',
                                'icon'        => 'fa-map-marker-alt',
                                'searchUrl'   => route('waypoints.search'),
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Horaires</label>
                        </div>
                        <div class="field-body">

                            {{-- START TIME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'planned_at',
                                'placeholder' => "Type de véhicule",
                                'type'        => 'datetime-local',
                                'icon'        => 'fa-clock',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- END TIME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'end_planned_at',
                                'placeholder' => "Véhicule",
                                'type'        => 'datetime-local',
                                'icon'        => 'fa-clock',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <h2 class="title is-4">Conducteurs</h3>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Runner</label>
                        </div>
                        <div class="field-body">

                            {{-- RUNNER --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'phone_number',
                                'placeholder' => "Conducteur",
                                'type'        => 'text',
                                'icon'        => 'fa-user',
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

                            {{-- CAR TYPE --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'phone_number',
                                'placeholder' => "Type de véhicule",
                                'type'        => 'text',
                                'icon'        => 'fa-truck',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- CAR --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'email',
                                'placeholder' => "Véhicule",
                                'type'        => 'text',
                                'icon'        => 'fa-car',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Sexe</label>
                        </div>
                        <div class="field-body">

                            {{-- SEX --}}
                            <div class="field is-pulled-right">
                                <p class="control">
                                    <a class="button is-info">
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span>Ajouter un runner</span>
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- SUBMIT BUTTONS --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Créer l'utilisateur
                                    </button>
                                </div>
                                <p class="help">
                                    Par défault les nouveaux utilisateurs sont crées sans mot de passes.
                                    Il faut qu'ils confirment leur participation pour créer un login.
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