{{--
  -- Cars creation
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('cars.index') }}">Véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Créer un véhicule</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Créer un véhicule</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('cars.store') }}" method="POST">

                    {{ csrf_field() }}

                    {{-- Form create car --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Numéro de plaque</label>
                        </div>
                        <div class="field-body">

                            {{-- Plate number --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'plate_number',
                                'placeholder' => 'Numéro de plaque',
                                'type'        => 'text',
                                'icon'        => 'fa-id-card',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Marque</label>
                        </div>
                        <div class="field-body">

                            {{-- Brand --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'brand',
                                'placeholder' => 'Marque',
                                'type'        => 'text',
                                'icon'        => 'fa-car',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Modèle</label>
                        </div>
                        <div class="field-body">

                            {{-- Model --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'model',
                                'placeholder' => 'Modèle',
                                'type'        => 'text',
                                'icon'        => 'fa-car',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Couleur</label>
                        </div>
                        <div class="field-body">

                            {{-- Color --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'color',
                                'placeholder' => 'Couleur',
                                'type'        => 'text',
                                'icon'        => 'fa-thumbtack',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Status</label>
                        </div>
                        <div class="field-body">

                            {{-- Status --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="status">
                                            <option value="free">Libre</option>
                                            <option value="problem">Problème</option>
                                            <option value="taken">En run</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- end form --}}

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- Submit button --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Créer le véhicule
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
