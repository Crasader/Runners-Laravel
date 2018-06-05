{{--
  -- Artist edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('artists.index') }}">Artistes</a></li>
<li><a href="{{ route('artists.show', ['artist' => $artist->id]) }}">{{ $artist->name }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Modifier l'artiste : {{ $artist->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', App\Artist::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('edit-artist-form').submit();"
                                class="button is-success">
                                Editer {{ $artist->name }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="edit-artist-form" action="{{ route('artists.update', ['artist' => $artist->id]) }}" method="POST">

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
                                'placeholder' => "Nom de l'artiste",
                                'type'        => 'text',
                                'value'       => $artist->name,
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