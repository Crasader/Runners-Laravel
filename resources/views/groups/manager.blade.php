{{--
  -- Show group details
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="{{ route('groups.index') }}">Groups</a></li>
<li class="is-active"><a href="#" aria-current="page">Manager</a></li>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/groups/manager.js') }}"></script>
@endpush
  
@section('content')

<div class="section">
    <div class="container">

        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Gestion des groupes</h1>
            </div>
        </div>

        {{-- Filters --}}
        <div class="columns">
            <div class="column is-12">
                filters
            </div>
        </div>

        <form action="{{ route('groups.manager.update') }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="columns is-multiline">
                @foreach($groups as $group)
                    <div class="column is-4">
                        <div class="box" style="background-color: #{{ $group->color }};">
                            <div class="content">
                                <h2>{{ $group->name }}</h2>
                                <ul id="group{{ $group->id }}">
                                    @foreach($group->users as $user)
                                        <li name="user[{{ $user->id }}]" class="cursor-pointer">{{ $user->fullname }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="columns">
                <div class="column">
                    <button class="button" type="submit">Envoyer</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection