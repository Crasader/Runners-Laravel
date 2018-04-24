{{--
  -- Cars edition
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('cars.index') }}">Véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Modifier un véhicule</a></li>
@endsection

@section('content')


<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Modifier un véhicule</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('cars.update', ['car' => $car->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    {{-- Form edit car --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Numéro de plaque</label>
                        </div>
                        <div class="field-body">

                            {{-- Plate number --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'plate_number',
                                'placeholder' => 'Numéro de plaque',
                                'value'       => $car->plate_number,
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
                                'placeholder' => 'Prénom',
                                'value'       => $car->brand,
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
                                'value'       => $car->model,
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
                                'value'       => $car->color,
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
                                            @switch($car->status)
                                            @case('problem')
                                                <option value="free">Libre</option>
                                                <option value="problem" selected>Problème</option>
                                                <option value="taken">En run</option>
                                                @break

                                            @case('taken')
                                                <option value="free">Libre</option>
                                                <option value="problem">Problème</option>
                                                <option value="taken" selected>En run</option>
                                                @break
                                        
                                            @default
                                                <option value="free" selected>Libre</option>
                                                <option value="problem">Problème</option>
                                                <option value="taken">En run</option>
                                        @endswitch
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Type</label>
                        </div>
                        <div class="field-body">

                            {{-- Status --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="status">
                                            @foreach (App\CarType::all() as $cartype)
                                                <option value="free" {{ $car->type->id === $cartype->id ? 'selected' : '' }}>{{$cartype->name}}</option>
                                            @endforeach

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
                                        Modifier le véhicule
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
