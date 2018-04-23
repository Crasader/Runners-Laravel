{{--
  -- Show specified user
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Utilisateur</a></li>
<li><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->fullname }}</a></li>
<li class="is-active"><a href="#" aria-current="page">Edition</a></li>
@endsection
  
@section('content')

<div class="section">
    <div class="container">

        {{-- --------------------- --}}
        {{-- HEADER                --}}
        {{-- --------------------- --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">
                    {{ $user->fullname }}
                    @component('components/status_tag', ['status' => $user->status])
                    @endcomponent
                </h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('update', $user)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-user-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </p>
                    @endcan
                    @can('delete', $user)
                        <p class="control">
                            <form id="delete-user-form"
                                action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                    method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <button onclick="event.preventDefault();
                                document.getElementById('delete-user-form').submit();"
                                class="button is-danger">
                                Supprimer {{ $user->fullname }}
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-4">
                <h2 class="title is-3">Information générales</h2>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="update-user-form" action="{{ route('users.update', ['user' => $user->id]) }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'lastname',
                                'placeholder' => 'Nom',
                                'value'       => $user->lastname,
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- FIRSTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'firstname',
                                'placeholder' => 'Prénom',
                                'value'       => $user->firstname,
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

                            {{-- USERNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'name',
                                'placeholder' => "Nom d'utilisateur",
                                'value'       => $user->name,
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Coordonées</label>
                        </div>
                        <div class="field-body">

                            {{-- PHONE NUMBER --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'phone_number',
                                'placeholder' => "Numéro de téléphone",
                                'value'       => $user->phone_number,
                                'type'        => 'text',
                                'icon'        => 'fa-phone',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- EMAIL --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'email',
                                'placeholder' => "Adresse e-mail",
                                'value'       => $user->email,
                                'type'        => 'text',
                                'icon'        => 'fa-envelope',
                                'errors'      => $errors
                                ])
                            @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Sexe</label>
                        </div>
                        <div class="field-body">

                            {{-- SEX --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="sex">
                                            <option value="m" {{ ($user->sex === 'm') ? 'selected' : '' }}>Homme</option>
                                            <option value="w" {{ ($user->sex === 'w') ? 'selected' : '' }}>Femme</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>

        <div class="columns">
            <div class="column is-4">
                <h2 class="title is-3">Images</h2>
            </div>
        </div>

    </div>
</div>

@endsection