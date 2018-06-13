{{--
  -- Users creation
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('content')

<div class="section homepage">
    <div class="container">

        <h1 class="title is-3 has-text-centered">Informations : </h1>

        {{-- Copyright --}}
        <div class="content has-text-centered">
            <h4>App :</h4>
            <p>
                <strong><a href="https://github.com/CPNV-ES/Runners-Laravel">Runners</a></strong> <strong>{{ config('app.version') }}</strong>
                ©CPNV-ES {{ date("Y") }}
            </p>
        </div>

        <div class="content has-text-centered">
            <h4>Framework :</h4>
            <p>
                Laravel : <strong>{{ App::VERSION() }}</strong>
            </p>
        </div>

    </div>
</div>

@endsection
