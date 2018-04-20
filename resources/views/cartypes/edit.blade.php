{{--
  -- Cartypes edition
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('carTypes.index') }}">Types de véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Modifier le type</a></li>
@endsection

@section('content')


<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Modifier un type de véhicule</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('carTypes.update', ['carType' => $carType->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    {{-- Form edit car --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- Plate number --}}
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

                    {{-- end form --}}

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- Submit button --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Modifier le type véhicule
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