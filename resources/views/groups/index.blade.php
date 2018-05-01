{{--
  -- Groups index
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Groupes</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des groupes</h1>
            </div>
            <div class="column">
                @can('create', App\Group::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('groups.create') }}" class="button is-info">Nouveau groupe</a>
                        </p>
                    </div>
                @endcan
            </div>
        </div>

        {{-- Filters --}}
        <div class="columns">
            <div class="column is-12">
                filters
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Couleur</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Couleur</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <th>{{ $group->name }}</th>
                                {{-- Display a tag with the group background color --}}
                                <td><span class="tag" style="background-color: #{{ $group->color }};">{{ $group->color }}</span></td>
                                <td>
                                    {{-- Edition buttons --}}
                                    <div class="buttons has-addons is-right">
                                        <a href="{{ route('groups.edit', ['group' => $group->id]) }}" class="button is-small is-link">
                                            Edit
                                        </a>
                                        <a href="{{ route('groups.show', ['group' => $group->id]) }}" class="button is-small is-link">
                                            Show
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        {{ $groups->links() }}

    </div>
</div>

@endsection