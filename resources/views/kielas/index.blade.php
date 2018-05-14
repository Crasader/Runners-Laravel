{{--
  -- Cars index
  --
  -- @author Nicolas Henry
  --}}

  @extends('layouts.app')

  @section('breadcrum')
  <li class="is-active"><a href="#" aria-current="page">Kiéla?</a></li>
  @endsection
  
  @section('content')
  
  <div class="section">
      <div class="container">
          <div class="columns">
              <div class="column is-8">
                  <h1 class="title is-2">Kiéla?</h1>
                  {{$festival->name}}
                  {{$now}}
              </div>
          </div>
          <div class="columns">
              <div class="column is-4">
                @foreach ($groups as $group)
                    {{$group->name}}<br>
                @endforeach
              </div>

              <div class="column is-4">
                @foreach ($users as $user)
                    {{$user->firstname}}<br>
                @endforeach
              </div>

              <div class="column is-4">
                @foreach ($cars as $car)
                    {{$car->plate_number}}<br>
                @endforeach
              </div>
          </div>
      </div>
  </div>
  
  @endsection
  