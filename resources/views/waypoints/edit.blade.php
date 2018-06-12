{{--
  -- Waypoint edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('waypoints.index') }}">Lieux</a></li>
<li><a href="{{ route('waypoints.show', ['waypoint' => $waypoint->id]) }}">{{ $waypoint->name }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Modifier le lieu : {{ $waypoint->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $waypoint)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('edit-waypoint-form').submit();"
                                class="button is-success">
                                Editer {{ $waypoint->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="edit-waypoint-form" action="{{ route('waypoints.update', ['waypoint' => $waypoint->id]) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

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
                                'value'       => $waypoint->name,
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