{{--
  -- Groups edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('groups.index') }}">Groupes</a></li>
<li><a href="{{ route('groups.show', ['group' => $group->id]) }}">{{ $group->name }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Modifier le groupe <span class="tag is-large" style="background-color: #{{ $group->color }};">{{ $group->name }}</span></h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', App\Artist::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('edit-group-form').submit();"
                                class="button is-success">
                                Editer le groupe {{ $group->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="edit-group-form" action="{{ route('groups.update', ['group' => $group->id]) }}" method="POST">

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
                                'placeholder' => 'Nom du groupe',
                                'type'        => 'text',
                                'icon'        => 'fa-tag',
                                'value'       => $group->name,
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- GROUP COLOR --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'color',
                                'placeholder' => 'Couleur',
                                'type'        => 'text',
                                'icon'        => 'fa-adjust',
                                'value'       => $group->color,
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    La couleur doit être au format hexadécimal (ex: 554ef3).
                                </p>
                            @endcomponent

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection