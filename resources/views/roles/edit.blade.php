{{--
  -- Roles edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('roles.index') }}">Roles</a></li>
<li><a href="{{ route('roles.show', ['role' => $role->id]) }}">{{ $role->slug }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Edition du role {{ $role->name }}</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <button onclick="event.preventDefault();
                            document.getElementById('update-role-form').submit();"
                            class="button is-success">
                            Modifier le role
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="update-role-form" action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

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
                                'icon'        => 'fa-bookmark',
                                'errors'      => $errors,
                                'value'       => $role->slug
                                 ])
                                <p class="help">
                                    Le slug ne possède que des minuscules et des tirets.
                                </p>
                            @endcomponent

                            {{-- FIRSTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => 'Nom du role',
                                'type'        => 'text',
                                'icon'        => 'fa-i-cursor',
                                'errors'      => $errors,
                                'value'       => $role->slug
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
                            @foreach ($role->permissions as $key => $value)
                                @break($loop->index == 9)
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field is-narrow">
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="permissions[{{ $key }}]">
                                                        <option value="true" {{ ($value == 'true') ? 'selected' : '' }}>Autorisé à :</option>
                                                        <option value="false" {{ ($value == 'false') ? 'selected' : '' }}>Non Autorisé à :</option>
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
                            @foreach ($role->permissions as $key => $value)
                                @continue($loop->index <= 8)
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field is-narrow">
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="permissions[{{ $key }}]">
                                                        <option value="true" {{ ($value == 'true') ? 'selected' : '' }}>Autorisé à :</option>
                                                        <option value="false" {{ ($value == 'false') ? 'selected' : '' }}>Non Autorisé à :</option>
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

                    <div class="field is-grouped is-grouped-centered">
                        <div class="control">
                            <button type="submit" class="button is-success">
                                Modifier le role
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection