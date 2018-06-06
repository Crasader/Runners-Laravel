@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    {{-- TITLE --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <h1 class="title is-2">Login</h1>
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Email</label>
                        </div>
                        <div class="field-body">
                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'email',
                                'placeholder' => "Votre email utilisé pour s'authentifier",
                                'type'        => 'text',
                                'icon'        => 'fa-user',
                                'errors'      => $errors
                                ])
                            @endcomponent
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Email</label>
                        </div>
                        <div class="field-body">
                            {{-- LASTNAME --}}
                            @component('components/horizontal_form_input', [
                                'name'        => 'password',
                                'placeholder' => "Votre mot-de-passe",
                                'type'        => 'password',
                                'icon'        => 'fa-lock',
                                'errors'      => $errors
                                ])
                            @endcomponent
                        </div>
                    </div>

                    {{-- REMEMBER ME --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <div class="field is-narrow">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <div class="field is-narrow">
                                <div class="control">
                                    <button type="submit" class="btn btn-primary button is-info">
                                        Login
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
