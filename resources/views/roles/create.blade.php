{{--
  -- Roles creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Gestion des roles</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouveau role</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Création d'un role</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('roles.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom du role :</label>
                        </div>
                        <div class="field-body">

                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'slug',
                                'placeholder' => 'Slug',
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Le slug ne possède que des minuscules.
                                </p>
                            @endcomponent

                            {{-- FIRSTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => 'Nom du role',
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                                <p class="help">
                                    Décris intuitivement le role.
                                </p>
                            @endcomponent

                        </div>
                    </div>

                    {{-- Display all the permissions with a little select to athorize or not the permission for this role --}}
                    <div class="columns">
                        <dim class="column">
                            <h2 class="title is-4">Choissisez les permissions autorisées pour ce role :</h2>
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
                                                    <select name="permission[{{ $key }}]">
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
                                                    <select name="permission[{{ $key }}]">
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
                                @break($loop->index == 8)
                            @endforeach
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- SUBMIT BUTTONS --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Créer le nouveau role
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