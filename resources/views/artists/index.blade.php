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
                    </div>
                @endcan
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Utilisation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Utilisation</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($artists as $artist)
                            <tr onclick="window.location.href = '{{ route('artists.show', ['user' => $artist->id]) }}'">
                                <th>{{ $artist->name }}</th>
                                <td><strong>{{ $artist->runs()->count() }}</strong> runs transportent cet artiste.</td>
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