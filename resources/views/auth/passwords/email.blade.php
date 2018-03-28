@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">
            <div class="panel panel-default">
                <div class="title is-1">Reset Password</div>
                <hr>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label label">E-Mail Address</label>

                            <div class="">
                                <input id="email" type="email" class="form-control input is-info" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary button is-info">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
