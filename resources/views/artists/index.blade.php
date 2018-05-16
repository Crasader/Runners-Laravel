{{--
  -- Artists index
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Artistes</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Liste des artistes enregistrés</h1>
            </div>
            <div class="column">
                @can('create', App\Artist::class)
                    <div class="field is-grouped is-pulled-right">
                        <p class="control">
                            <a href="{{ route('artists.create') }}" class="button is-info">Nouvel artiste</a>
                        </p>
                        <p class="control">
                            <a href="{{ route('artists.import-form') }}" class="button is-primary">Importer une liste d'artistes</a>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($artists as $artist)
                            <tr>
                                <th>{{ $artist->name }}</th>
                                <td>
                                    {{-- Edition buttons --}}
                                    <div class="buttons has-addons is-right">
                                        <a href="{{ route('artists.edit', ['user' => $artist->id]) }}" class="button is-small is-link">
                                            Edit
                                        </a>
                                        <a href="{{ route('artists.show', ['user' => $artist->id]) }}" class="button is-small is-link">
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
        {{ $artists->links() }}

    </div>
</div>

@endsection