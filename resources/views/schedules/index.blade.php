{{--
    -- Schedules index
    --
    -- @author Nicolas Henry
    --}}

@extends('layouts.app')

@section('breadcrum')
<li><a href="#">Horaires</a></li>
@endsection

@section('content')

<div class="section">
    <div class="container">

        {{-- Title and controls --}}
        <div class="columns">
            <div class="column is-narrow">
                <h1 class="title is-2">{{ $festival->name }}</h1>
            </div>
            <div class="column">
                tutu
            </div>
        </div>

        {{-- The table --}}
        <div class="columns">
            <div class="column is-12">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            {{$begin = (new Illuminate\Support\Carbon)->parse($festival->starts_on)}}
                            {{$begin->subDay()}}
                            {{$begin2 = (new Illuminate\Support\Carbon)->parse($festival->starts_on)}}
                            {{$begin2->subDay()}}

                            {{$range = $festival->starts_on->diffInDays($festival->ends_on)+1}}
                            @for ($i = 0; $i < $range; $i++)
                                <th>{{$begin->addDay()->format('l jS F Y')}}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            @for ($i = 0; $i < $range; $i++)
                                <th>{{$begin2->addDay()->format('l jS F Y')}}</th>
                            @endfor
                        </tr>
                    </tfoot>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>




@endsection
  