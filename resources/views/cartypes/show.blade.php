{{--
  -- Show specified car type
  --
  -- @author Nicolas Henry
  --}}

  @extends('layouts.app')

  @section('breadcrum')
  <li><a href="{{ route('carTypes.index') }}">Types de véhicules</a></li>
  <li class="is-active"><a href="#" aria-current="page">Véhicule de type {{ $carType->name }}</a></li>
  @endsection
  
  @section('content')
  
  <div class="section">
      <div class="container">
          <div class="columns">
              <div class="column is-12">
                  <div class="panel panel-default">
                      <div class="title is-2">Véhicule de type {{$carType->name}}</div>
                      <table class="table is-fullwidth">
                          <thead>
                              <tr>
                                  <th>Nom</th>
                                  <th>Description</th>
                                  <th>Nombre de place</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>{{ $carType->name }}</td>
                                  <td>{{ $carType->description }}</td>
                                  <td>{{ $carType->nb_place }}</td>
                              </tr>
                          </tbody>
                      </table>
  
                      <div class="field is-grouped buttons has-addons">
                          <a href="{{ route('carTypes.index') }}" class="button is-info">Retour</a>
                          <form method="POST" class="form-horizontal" action="{{ route('carTypes.destroy', ['carType' => $carType->id]) }}">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type="submit" class="button is-danger">Supprimer {{$carType->name}}</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  @endsection
  