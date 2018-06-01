{{--
  -- Runs big page
  -- Display the runs for big screen display
  --
  -- @author Bastien Nicoud
  --}}

@extends('layouts.big_app')

@section('breadcrum')
<li class="is-active"><a href="#" aria-current="page">Liste des runs</a></li>
@endsection

@push('styles')
    <link href="{{ mix('css/big_runs.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush

@section('content')

<div class="section">
    <div class="container is-fluid">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">Runs</h1>
            </div>
            <div class="column">
                <div class="field is-grouped is-pulled-right">
                    <p class="control">
                        <a href="{{ route('runs.index') }}" class="button is-info">Retour</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Iterates all the runs --}}
        <div class="columns is-multiline">
            @foreach ($runs as $run)
                <div class="column is-12">
                    <div class="box">
                        <div class="columns">
                            <div class="column is-3 has-background-light">
                                <h2 class="title is-5">
                                    {{ $run->name }}
                                </h2>
                                @component('components/status_tag', ['status' => $run->status])
                                @endcomponent
                            </div>
                            <div class="column is-6">
                                <div class="columns">
                                    <div class="column is-6">
                                        <h3 class="title is-6">{{ $run->waypoints->first()->name }}</h3>
                                        <h4 class="title is-6">{{ $run->planned_at->format('H \h i') }}</h4>
                                    </div>
                                    <div class="column is-6">
                                        <h3 class="title is-6">{{ $run->waypoints->last()->name }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                @foreach ($run->subscriptions as $sub)
                                    <div class="columns">
                                        <div class="column is-6">
                                            <h4 class="subtitle is-5">{{ $sub->car->name }}</h4>
                                        </div>
                                        <div class="column is-6">
                                            <h4 class="subtitle is-5">{{ $sub->user->firstname }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection