{{--
  -- Users creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Utilisateurs</a></li>
<li class="is-active"><a href="#" aria-current="page">Nouvel utilisateur</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Nouvel utilisateur</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('create', App\User::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('create-user-form').submit();"
                                class="button is-success">
                                Créer l'utilisateur
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form id="create-user-form" action="{{ route('users.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nom</label>
                        </div>
                        <div class="field-body">

                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'lastname',
                                'placeholder' => 'Nom',
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- FIRSTNAME --}}
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
                        <div class="field-label is-normal">
                            <label class="label">Coordonées</label>
                        </div>
                        <div class="field-body">

                            {{-- PHONE NUMBER --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'phone_number',
                                'placeholder' => "Numéro de téléphone",
                                'type'        => 'text',
                                'icon'        => 'fa-phone',
                                'errors'      => $errors
                                ])
                            @endcomponent

                            {{-- EMAIL --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'email',
                                'placeholder' => "Adresse e-mail",
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
                                            <option value="m">Homme</option>
                                            <option value="w">Femme</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Role</label>
                        </div>
                        <div class="field-body">

                            {{-- ROLE --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="role">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->slug }}" {{ ($role->slug === 'runner') ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p class="help">
                                    Par défaut les nouveaux utilisateurs sont créés sans mot de passe.
                                    Il faut qu'ils confirment leur participation pour créer un login.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Status</label>
                        </div>
                        <div class="field-body">

                            {{-- ROLE --}}
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="status">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->slug }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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