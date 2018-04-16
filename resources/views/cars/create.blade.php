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

                <form id="txt" class="form-horizontal" method="POST" action="{{ route('cars.store') }}">
                    {{ csrf_field() }}

                    <div class="field form-group{{ $errors->has('plate_number') ? ' has-error' : '' }}">
                        <label for="plate_number" class="col-md-4 control-label label">plate number</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="plate_number" value="" required autofocus>
                            
                            @if ($errors->has('plate_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('plate_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
                        <label for="brand" class="col-md-4 control-label label">brand</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="brand" value="" required autofocus>
                            
                            @if ($errors->has('brand'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('brand') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                        <label for="model" class="col-md-4 control-label label">model</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="model" value="" required autofocus>
                            
                            @if ($errors->has('model'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('model') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                        <label for="color" class="col-md-4 control-label label">color</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="color" value="" required autofocus>
                            
                            @if ($errors->has('color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="field form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="status" class="col-md-4 control-label label">status</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input is-info" name="status" value="" required autofocus>
                            
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
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
