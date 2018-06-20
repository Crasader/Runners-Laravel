{{--
  -- Show specified user
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('js/pages/users/edit.js') }}"></script>
@endpush

@section('content')

    <div class="section">
        <div class="container">

            {{-- --------------------- --}}
            {{-- HEADER                --}}
            {{-- --------------------- --}}
            <div class="columns">
                <div class="column is-narrow">
                    <h1 class="title is-2">
                        Changer le mot de passe de {{ $user->fullname }} :
                        {{-- Display the current status of user --}}
                        {{-- @component('components/status_tag', ['status' => $user->status()->slug])
                        @endcomponent --}}
                    </h1>
                </div>
                {{-- Controls buttons on the top --}}
                <div class="column">
                    <div class="field is-grouped is-pulled-right">
                        @can('changePass', $user)
                            <div class="control">
                                <button onclick="event.preventDefault();
                                document.getElementById('update-user-pass-form').submit();"
                                        class="button is-success">
                                    Mettre a jour le mot-de-passe
                                </button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            {{-- --------------------- --}}
            {{-- Edition fields        --}}
            {{-- --------------------- --}}
            <div class="columns">
                <div class="column">

                    <form id="update-user-pass-form" action="{{ route('users.pass.update', ['user' => $user->id]) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Nouveau mot de passe</label>
                            </div>
                            <div class="field-body">

                                {{-- PASSWORD --}}
                                @component('components/horizontal_form_input', [
                                    'name'        => 'password',
                                    'placeholder' => 'Nouveau mot de passe',
                                    'type'        => 'password',
                                    'icon'        => 'fa-lock',
                                    'errors'      => $errors
                                    ])
                                @endcomponent

                                {{-- CONFIRM PASSWORD --}}
                                @component('components/horizontal_form_input', [
                                    'name'        => 'password_confirmation',
                                    'placeholder' => 'Confirmer le mot de passe',
                                    'type'        => 'password',
                                    'icon'        => 'fa-lock',
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