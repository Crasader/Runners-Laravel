{{--
  -- Artist creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('artists.index') }}">Artistes</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouvel artiste</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Nouvel artiste</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('create', App\Artist::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('create-waypoint-form').submit();"
                                class="button is-success">
                                Créer l'artiste
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="create-waypoint-form" action="{{ route('artists.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- ARTIST NAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => "Nom de l'artiste",
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