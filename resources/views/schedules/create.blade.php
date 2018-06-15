{{--
    -- Schedules create
    --
    -- @author Nicolas Henry
    --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('schedules.index') }}">Horaires</a></li>
<li class="is-active"><a href="#" aria-current="page">Création</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Nouvel horaire</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('create', App\Schedule::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('create-schedule-form').submit();"
                                class="button is-success">
                                Ajouter l'horaire
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="create-schedule-form" action="{{ route('schedules.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Groupe</label>
                        </div>
                        <div class="field-body">

                            {{-- ROLE --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="group_id">
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Heure de début :</label>
                        </div>
                        <div class="field-body">

                            {{-- START TIME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'start_time',
                                'placeholder' => "Heure de départ",
                                'type'        => 'datetime-local',
                                'icon'        => 'fa-tag',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Heure de fin :</label>
                        </div>
                        <div class="field-body">

                            {{-- END TIME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'end_time',
                                'placeholder' => "Heure de fin",
                                'type'        => 'datetime-local',
                                'icon'        => 'fa-tag',
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
