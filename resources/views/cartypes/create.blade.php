{{--
  -- Cars type creation
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('carTypes.index') }}">Types de véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Créer un type véhicule</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Créer un type véhicule</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('carTypes.store') }}" method="POST">

                    {{ csrf_field() }}

                    {{-- Form create car type --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- name --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => 'Nom',
                                'type'        => 'text',
                                'icon'        => 'fa-id-card',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Description</label>
                        </div>
                        <div class="field-body">

                            {{-- description --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'description',
                                'placeholder' => 'Description',
                                'type'        => 'text',
                                'icon'        => 'fa-pencil-alt',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nombre de place</label>
                        </div>
                        <div class="field-body">

                            {{-- nb_place --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'nb_place',
                                'placeholder' => 'Nombre de place',
                                'type'        => 'text',
                                'icon'        => 'fa-sort-numeric-up',
                                'errors'      => $errors
                                ])
                            @endcomponent

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
                                        Créer le type de véhicule
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
