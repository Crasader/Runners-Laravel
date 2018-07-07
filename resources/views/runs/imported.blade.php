{{--
  -- Runs edition
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.app')

@section('content')

    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-narrow">
                    <h1 class="title is-2">Runs créés</h1>
                </div>
            </div>

            <div class="columns">
                <div class="column is-12">
                    @forelse ($runs as $run)
                        <h2 onclick="window.location.href = '{{ route('runs.show', ['user' => $run->id]) }}'">{{ $run->name }}, {{ $run->passengers }}pax, {{ (new \Carbon\Carbon($run->planned_at))->formatLocalized('%A %d, %H:%M') }} </h2>
                    @empty
                        <span class="tag is-warning is-medium"><strong>Aucun!!</strong></span>
                    @endforelse
                </div>
            </div>
        </div>

@endsection