{{--
  -- 404 error page
  --
  --}}
@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Erreur 404</a></li>
@endsection

@section('content')

<div class="section homepage">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-narrow">
                <h1 class="title is-1">- 404 -</h1>
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-narrow">
                <h2 class="title is-3">La page n'existe pas</h2>
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-narrow">
                <h2 class="title is-2">{{ $exception->getMessage() }}</h2>
            </div>
        </div>
    </div>
</div>

@endsection
