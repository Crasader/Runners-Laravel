{{--
  -- Cartypes edition
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('carTypes.index') }}">Types de véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Modifier {{ $carType->name }}</a></li>
@endsection

@section('content')


<div class="section">
    <div class="container">
        {{-- --------------------- --}}
        {{-- HEADER                --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    Modifier {{ $carType->name }}
                </h1>
            </div>
            {{-- Controls buttons on the top --}}
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $carType)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-cartype-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </p>
                    @endcan
                    @can('delete', $carType)
                        <p class="control">
                            <form id="delete-cartype-form"
                                action="{{ route('carTypes.destroy', ['carType' => $carType->id]) }}"
                                method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-cartype-form').submit();"
                                class="button is-danger">
                                Supprimer {{ $carType->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="update-cartype-form" action="{{ route('carTypes.update', ['carType' => $carType->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    {{-- Form edit car type --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- name --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => 'Nom',
                                'value'       => $carType->name,
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
                                'value'       => $carType->description,
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
                                'value'       => $carType->nb_place,
                                'type'        => 'text',
                                'icon'        => 'fa-sort-numeric-up',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection