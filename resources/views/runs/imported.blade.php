{{--
  -- Runs edition
  --
  -- @author Bastien Nicoud/Xavier Carrel
  --}}

@extends('layouts.app')

@section('content')

    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-narrow">
                    <h3 class="title is-2">Runs créés</h3>
                </div>
            </div>
            <div class="columns">
                <div class="column is-12">
                    @forelse ($runs as $run)
                        <p onclick="window.location.href = '{{ route('runs.show', ['user' => $run->id]) }}'">{{ $run->name }}, {{ $run->passengers }}pax, {{ (new \Carbon\Carbon($run->planned_at))->formatLocalized('%A %d, %H:%M') }} </p>
                    @empty
                        <span class="tag is-warning is-medium"><strong>Aucun!!</strong></span>
                    @endforelse
                </div>
            </div>
            <div class="columns">
                <div class="column is-narrow">
                    <h3 class="title is-2">Problèmes détectés dans le fichier</h3>
                </div>
            </div>
            <div class="columns">
                <div class="column is-12">
                    @forelse ($badtrips as $badtrip)
                        <p>{{ $badtrip }}</p>
                    @empty
                        <span class="tag is-warning is-medium"><strong>Aucun!!</strong></span>
                    @endforelse
                </div>
            </div>
            <div class="columns">
                <div class="column is-narrow">
                    <h3 class="title is-2">Déjà importés</h3>
                </div>
            </div>
            <div class="columns">
                <div class="column is-12">
                    @forelse ($alreadyimported as $trip)
                        <p>{{ $trip }}</p>
                    @empty
                        <span class="tag is-warning is-medium"><strong>Aucun!!</strong></span>
                    @endforelse
                </div>
            </div>
        </div>

@endsection