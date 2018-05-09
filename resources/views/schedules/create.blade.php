{{--
    -- Schedules create
    --
    -- @author Nicolas Henry
    --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('schedules.index') }}">Horaires</a></li>
<li class="is-active"><a href="#" aria-current="page">Horaires</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Nouvel horaire</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('schedules.store') }}" method="POST">

                    {{ csrf_field() }}
                    
                    {{-- Form create schedule --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Heure de début</label>
                        </div>
                        <div class="field-body">

                            {{-- Plate number --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'start_time',
                                'placeholder' => 'Heure de début',
                                'type'        => 'text',
                                'icon'        => 'fa-id-card',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- Submit button --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Créer l'horaire
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
  