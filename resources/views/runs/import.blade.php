{{--
  -- Runs edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('content')

    <div class="section">
        <div class="container">
            <h1 class="title is-2">
                Importation de runs
            </h1>
            <form id="import-runs" action="{{ route('runs.importfile') }}" method="POST" enctype="multipart/form-data">
                Fichier: <input type="file" name="file" />
                {{ csrf_field() }}
                {{ method_field('POST') }}
            </form>
            <br>
            <button onclick="event.preventDefault();
                                document.getElementById('import-runs').submit();"
                    class="button is-info">
                Importer
            </button>
        </div>
    </div>

@endsection