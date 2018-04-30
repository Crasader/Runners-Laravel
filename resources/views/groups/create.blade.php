{{--
  -- Groups creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('groups.index') }}">Groupes</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouveau groupe</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Nouveau groupe</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('groups.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- GROUP NAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'lastname',
                                'placeholder' => 'Nom du groupe',
                                'type'        => 'text',
                                'icon'        => 'fa-tag',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- GROUP COLOR --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'firstname',
                                'placeholder' => 'Prénom',
                                'type'        => 'text',
                                'icon'        => 'fa-user',
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
                                        Créer l'utilisateur
                                    </button>
                                </div>
                                <p class="help">
                                    Par défault les nouveaux utilisateurs sont crées sans mot de passes.
                                    Il faut qu'ils confirment leur participation pour créer un login.
                                </p>
                            </div>
                            
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection