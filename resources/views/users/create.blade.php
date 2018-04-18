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
            <div class="column is-12">
                <h1 class="title is-2">Nouvel utilisateur</h1>
            </div>
        </div>

        <div class="column">

            <form action="{{ route('users.store') }}" method="post">

                {{ csrf_field() }}

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Nom</label>
                    </div>
                    <div class="field-body">

                        {{-- LASTNAME --}}
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input {{ $errors->has('lastname') ? ' is-danger' : '' }}"
                                    type="text"
                                    name="lastname"
                                    value="{{ old('lastname') }}"
                                    placeholder="Nom">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                            @if ($errors->has('lastname'))
                                <p class="help is-danger">{{ $errors->first('lastname') }}</p>
                            @endif
                        </div>

                        {{-- FIRSTNAME --}}
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input {{ $errors->has('firstname') ? ' is-danger' : '' }}"
                                    type="text"
                                    name="firstname"
                                    value="{{ old('firstname') }}"
                                    placeholder="Prénom">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                            @if ($errors->has('firstname'))
                                <p class="help is-danger">{{ $errors->first('firstname') }}</p>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label"></div>
                    <div class="field-body">

                        {{-- USERNAME --}}
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Nom d'utilisateur">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                            @if ($errors->has('name'))
                                <p class="help is-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Coordonées</label>
                    </div>
                    <div class="field-body">

                        {{-- PHONE NUMBER --}}
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input {{ $errors->has('phone_number') ? ' is-danger' : '' }}"
                                    type="text"
                                    name="phone_number"
                                    value="{{ old('phone_number') }}"
                                    placeholder="Numéro de téléphone">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </p>
                            @if ($errors->has('phone_number'))
                                <p class="help is-danger">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </div>

                        {{-- EMAIL --}}
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                    type="text"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Adresse e-mail">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                            @if ($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

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

@endsection