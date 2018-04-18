{{--
  -- Show specified user
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('users.index') }}">Utilisateur</a></li>
<li class="is-active"><a href="#" aria-current="page">{{ $user->name }}</a></li>
@endsection
  
@section('content')

<div class="section">
    <div class="container">
        <div class="columns">

        </div>
    </div>
</div>

@endsection