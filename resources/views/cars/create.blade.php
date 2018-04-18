{{--
  -- Cars creation
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('cars.index') }}">Véhicules</a></li>
<li class="is-active"><a href="#" aria-current="page">Créer</a></li>
@endsection

@section('content')

<div class="section">

    <div class="container">
        <div class="columns">
            <div class="column is-12">
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
                                        <strong class="has-text-danger">{{ $errors->first('plate_number') }}</strong>
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
                                        <strong class="has-text-danger">{{ $errors->first('brand') }}</strong>
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
                                        <strong class="has-text-danger">{{ $errors->first('model') }}</strong>
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
                                        <strong class="has-text-danger">{{ $errors->first('color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label label">status</label>

                            <div class="col-md-6">
                                <div class="control">
                                    <div class="select is-info">
                                        <select class="form-control" name="status">
                                            <option value="free">Libre</option>
                                            <option value="problem">Problème</option>
                                            <option value="taken">En run</option>
                                        </select>
                                    </div>
                                </div>
                                
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
</div>

@endsection
