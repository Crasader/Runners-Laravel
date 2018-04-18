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
                        <label class="label">Informations</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="lastname" placeholder="Nom">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="firstname" placeholder="Prénom">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label"></div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="name" placeholder="Nom d'utilisateur">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label"></div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="phone_number" placeholder="Numéro de téléphone">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="email" placeholder="Adresse e-mail">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
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
                    <div class="field-label">
                        <!-- Left empty for spacing -->
                    </div>
                    <div class="field-body">
                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Créer l'utilisateur
                                </button>
                            </div>
                            <div class="control">
                                <a href="{{ route('users.index') }}" class="button is-text">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection