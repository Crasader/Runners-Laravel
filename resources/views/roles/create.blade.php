{{--
  -- Roles creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('roles.index') }}">Gestion des rôles</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouveau rôle</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Création d'un rôle</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('roles.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom du rôle :</label>
                        </div>
                        <div class="field-body">

                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'slug',
                                'placeholder' => 'Slug',
                                'type'        => 'text',
                                'icon'        => 'fa-bookmark',
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Le slug ne possède que des minuscules et des tirets.
                                </p>
                            @endcomponent

                            {{-- FIRSTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => 'Nom du rôle',
                                'type'        => 'text',
                                'icon'        => 'fa-i-cursor',
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Décris intuitivement le rôle.
                                </p>
                            @endcomponent

                        </div>
                    </div>

                    {{-- Display all the permissions with a little select to athorize or not the permission for this role --}}
                    <div class="columns">
                        <dim class="column">
                            <h2 class="title is-4">Choisissez les permissions autorisées pour ce rôle :</h2>
                        </dim>
                    </div>
                    <div class="columns">
                        <div class="column is-half">
                            @foreach ($permissions as $key => $value)
                                @break($loop->index == 9)
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field is-narrow">
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="permissions[{{ $key }}]">
                                                        <option value="true">Autorisé à :</option>
                                                        <option value="false" selected>Non Autorisé à :</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-label is-normal">
                                        <label class="label">{{ $key }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="column is-half">
                            @foreach ($permissions as $key => $value)
                                @continue($loop->index <= 8)
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field is-narrow">
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="permissions[{{ $key }}]">
                                                        <option value="true">Autorisé à :</option>
                                                        <option value="false" selected>Non Autorisé à :</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-label is-normal">
                                        <label class="label">{{ $key }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="field is-grouped is-grouped-centered">
                        <div class="control">
                            <button type="submit" class="button is-primary">
                                Créer le nouveau rôle
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection