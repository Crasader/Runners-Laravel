@extends('layouts.app')

@section('content')
<div class="section">
    <div class="columns">
        <div class="column panel panel-default is-6 is-offset-3">
            <div class="title is-2">Create a car</div>
            <hr>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="txt" class="form-horizontal" method="POST" action="{{ route('cartypes.store') }}">
                    {{ csrf_field() }}

                    <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label label">Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="name" value="" required autofocus>
                            
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label label">Description</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="description" value="" required autofocus>
                            
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('nb_place') ? ' has-error' : '' }}">
                        <label for="nb_place" class="col-md-4 control-label label">Number place</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="nb_place" value="" required autofocus>
                            
                            @if ($errors->has('nb_place'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nb_place') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="button is-info">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
