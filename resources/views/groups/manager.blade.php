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

        <div class="columns is-multiline">
            @foreach($groups as $group)
                <div class="column is-4">
                    <div class="box">
                        <div class="content">
                            <h2>{{ $group->name }}</h2>
                            <ul>
                                @foreach($group->users as $user)
                                    <li>{{ $user->fullname }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection