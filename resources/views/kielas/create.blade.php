{{--
  -- Kielas create
  --
  -- @author Nicolas Henry
  --}}

@extends('layouts.app')

@section('breadcrum')
    <li><a href="{{ route('kiela.index') }}">Kiela</a></li>
    <li class="is-active"><a href="#" aria-current="page">Ajouter un chauffeur</a></li>
@endsection
  
@section('content')
  
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <h1 class="title is-2">Ajouter un chauffeur</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">

                <form action="{{ route('kiela.store') }}" method="POST">

                    {{ csrf_field() }}

                    {{-- Form add user --}}
                    <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Type</label>
                    </div>
                    <div class="field-body">

                        {{-- user_id --}}
                        <div class="field is-narrow">
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select name="user_id">
                                        @foreach (App\User::all() as $user)
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Heure de début</label>
                        </div>
                        <div class="field-body">

                        {{-- START TIME --}}
                        @component('components/horizontal_form_input', [
                            'name'        => 'start_time',
                            'placeholder' => "2018-04-19 15:25:39",
                            'type'        => 'datetime-local',
                            'icon'        => 'fa-hourglass-start',
                            'value'       => $now->format('Y-m-d\\TH:i:s'),
                            'errors'      => $errors
                            ])
                        @endcomponent

                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Heure de fin</label>
                        </div>
                        <div class="field-body">

                        {{-- END TIME --}}
                        @component('components/horizontal_form_input', [
                            'name'        => 'end_time',
                            'placeholder' => "Type de véhicule",
                            'type'        => 'datetime-local',
                            'icon'        => 'fa-hourglass-end',
                            'value'       => $now->addMinutes(60)->format('Y-m-d\\TH:i:s'),
                            'errors'      => $errors
                            ])
                        @endcomponent

                        </div>
                    </div>

                    {{-- end form --}}

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                            {{-- Submit button --}}
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        Ajouter le chauffeur
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  
@endsection
  