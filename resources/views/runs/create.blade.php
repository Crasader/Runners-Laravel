{{--
  -- Users creation
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
    {{-- Script for the search fields nesesary for right work of the component --}}
    <script src="{{ mix('js/features/search-field.js') }}"></script>
@endpush

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Nouveau run</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('runs.store') }}" method="POST">

                    {{ csrf_field() }}

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
                                'icon'        => 'fa-search',
                                'searchUrl'   => route('waypoints.search'),
                                'errors'      => $errors
                                ])
                                @slot('button')
                                    <button id="add-waypoint" data-waypoint-index="1" class="button is-info">
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
                                'icon'        => 'fa-search',
                                'searchUrl'   => route('waypoints.search'),
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Coordonées</label>
                        </div>
                        <div class="field-body">

                            {{-- PHONE NUMBER --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'phone_number',
                                'placeholder' => "Numéro de téléphone",
                                'type'        => 'text',
                                'icon'        => 'fa-phone',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- EMAIL --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'email',
                                'placeholder' => "Adresse e-mail",
                                'type'        => 'text',
                                'icon'        => 'fa-envelope',
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
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="sex">
                                            <option value="m">Homme</option>
                                            <option value="w">Femme</option>
                                        </select>
                                    </div>
                                </div>
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