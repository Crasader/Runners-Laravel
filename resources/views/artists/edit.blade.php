{{--
  -- Artist creation
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
            <div class="column is-12">
                <h1 class="title is-2">Modifier l'artiste : {{ $artist->name }}</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('artists.update', ['artist' => $artist->id]) }}" method="POST">

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

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- SUBMIT BUTTONS --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Modifier
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