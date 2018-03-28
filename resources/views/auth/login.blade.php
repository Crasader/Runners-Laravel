@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">
            <div class="title is-1">Login</div>
            <hr>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class=" control-label label">E-Mail Address</label>

                        <div class="control">
                            <input id="email" type="email" class="form-control input is-info" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label label">Password</label>

                        <div class="">
                            <input id="password" type="password" class="form-control input is-info" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group">
                        <div class="">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="field form-group">
                        <div class="control">
                            <button type="submit" class="btn btn-primary button is-info">
                                Login
                            </button>

                            <a class="btn btn-link button is-info" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
