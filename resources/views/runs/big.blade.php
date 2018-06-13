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
    <script src="{{ mix('js/pages/runs/big.js') }}"></script>
@endpush

@section('content')

<div class="section">
    <div class="container is-fluid">

        {{-- Iterates all the runs --}}
        <div class="columns is-multiline">
            @foreach ($runs as $run)
                <div class="column is-12 is-marginless is-paddingless">
                    <div class="box box-big has-border-black is-radiusless">
                        <div class="columns">
                            <div class="column is-3 has-background-light has-border-right">
                                <h2 class="title is-5 title-run">
                                    {{ $run->name }}
                                </h2>
                                @statustag(['status' => $run->status])
                                @endstatustag
                                <p>
                                    {{ $run->passengers }} personnes
                                </p>
                            </div>
                            <div class="column is-6 has-border-right">
                                <div class="columns is-multiline">
                                    <div class="column is-6">
                                        <h3 class="title is-5 title-run">{{ $run->waypoints->first()->name }}</h3>
                                        <h4 class="title is-5 title-run">
                                            @datetext(['date' => $run->planned_at])
                                            @enddatetext
                                        </h4>
                                    </div>
                                    <div class="column is-6">
                                        <h3 class="title is-5 title-run">{{ $run->waypoints->last()->name }}</h3>
                                        <p>{{ str_limit($run->infos, 200, ' ...') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                @foreach ($run->subscriptions as $sub)
                                    <div class="columns">
                                        <div class="column is-5">
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