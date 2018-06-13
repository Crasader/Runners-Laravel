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
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    @can('create', App\Group::class)
                        <p class="control">
                            <a href="{{ route('groups.create') }}" class="button is-info">Nouveau groupe</a>
                        </p>
                    @endcan
                    @can('update', App\Group::class)
                        <p class="control">
                            <button onclick="event.preventDefault();
                                document.getElementById('update-groups-form').submit();"
                                class="button is-success">
                                Valider les modifications
                            </button>
                        </p>
                    @endcan
                </div>
            </div>
        </div>

        {{--
            All the manager is surounded by a form, when we drag an element to another group
            sortable.js change his value to match the new group.
            Then when all the changes are done, the form send to the controller all asociation (user-id => group-id)
            --}}
        <form id="update-groups-form" action="{{ route('groups.manager.update') }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="columns">
                <div class="column is-9">
                    <div class="columns is-multiline">
                        @foreach($groups as $group)
                            <div class="column is-4">
                                <div class="box" style="background-color: #{{ $group->color }};">
                                    <div class="content">
                                        <h2><a href="{{ route('groups.show', ['group' => $group->id]) }}">{{ $group->name }}</a></h2>

                                        {{-- The id is user by sortable js for the mangment system (see the js of this page) --}}
                                        <ul id="group[{{ $group->id }}]" data-group-id="{{ $group->id }}" style="min-height: 60px;">
                                            @foreach($group->users as $user)
                                                <li class="cursor-pointer">
                                                    {{--<span class="icon">
                                                        <i class="fas fa-arrows-alt"></i>
                                                    </span>--}}
                                                    <input type="text" data-user-id="{{ $user->id }}" name="unused[{{ $user->id }}]" value="not-changed" style="display: none;">
                                                    {{ $user->fullname }}
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="column is-3">
                    <div class="box has-background-light">
                        <div class="content">
                            <h2>Sans groupe</h2>
                                {{-- The id is user by sortable js for the mangment system (see the js of this page) --}}
                                <ul id="group[no-group]" data-group-id="no-group" style="min-height: 60px;">
                                @foreach($usersWithoutGroup as $user)
                                    <li class="cursor-pointer">
                                        {{--<span class="icon">
                                            <i class="fas fa-arrows-alt"></i>
                                        </span>--}}
                                        <input type="text" data-user-id="{{ $user->id }}" name="unused[{{ $user->id }}]" value="not-changed" style="display: none;">
                                        {{ $user->fullname }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection