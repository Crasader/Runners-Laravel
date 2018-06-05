{{--
  -- Waypoints creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('waypoints.index') }}">Lieux</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouveau lieu</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Nouveau lieu</h1>
            </div>

            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('create', App\Waypoint::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('create-waypoint-form').submit();"
                                class="button is-success">
                                Créer le lieux
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="create-waypoint-form" action="{{ route('waypoints.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- GROUP NAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => "Nom du lieux",
                                'type'        => 'text',
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