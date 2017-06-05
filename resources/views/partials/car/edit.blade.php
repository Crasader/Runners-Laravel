<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">{{ $mode !== null && $mode === "edit" ? "Edition de la voiture " : "Création d'une voiture" }}</div>
            <div class="panel-body">
                <!-- si la voiture existe -->
                @if($car->exists)
                  {{ Form::model($car, array('route' => array('cars.update', $car), 'class' => 'form-horizontal', 'method' => 'put')) }}
                @else
                  {{ Form::open(array('route' => 'cars.store', 'class' => 'form-horizontal')) }}
                @endif
                {{ Form::bsText("Numéro de plaque","plate_number",$car->plate_number) }}
                {{ Form::bsText("Marque","brand",$car->brand) }}
                {{ Form::bsText("Model","model",$car->model) }}
                {{ Form::bsText("Couleur","color",$car->color) }}
                {{ Form::bsText("Nombre de place disponible","nb_place",$car->nb_place) }}
                {{ Form::bsText("Nom du véhicule","name",$car->name) }}
                <div class="form-group">
                  @foreach($errors as $er)
                    <div class="alert alert-danger">
                      {{ $er }}
                    </div>
                  @endforeach
                </div>
                @if($car->exists)
                {{ Form::bsSelect("Etat de la voiture","status",\App\Helpers\Status::getFullStatusForRessource($car),old("status",$car->status)) }}

                @endif
                {{ Form::bsSelect("Type de voiture","car_type",$car_types->mapWithKeys(function($t){return [" {$t->id}"=>$t->name];}),$car->car_type_id) }}
                <!-- <div class="form-group{{ $errors->has('car_type_id') ? ' has-error' : '' }}">
                  {{ Form::label('car_type_id', 'Type de voiture ', array('class' => 'col-md-4 control-label')) }}
                  <div class="col-md-6">
                    <select {{ $mode !== null && $mode === "edit" ? 'disabled' : ''}} id="car_type_id" name="type" class="form-control" required autofocus>
                      <option disabled>Sélectionnez un type...</option>
                      @foreach($car_types as $car_type)
                        @if(old("type") == $car_type->id)
                          <option value="{{ $car_type->id }}" selected>{{ $car_type->type }}</option>
                        @elseif($car->type !== null && $car_type->id == $car->type->id)
                          <option value="{{ $car_type->id }}" selected>{{ $car_type->type }}</option>
                        @else
                          <option value="{{ $car_type->id }}">{{ $car_type->type }}</option>
                        @endif
                      @endforeach
                    </select>
                    @if ($errors->has('car_type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('car_type_id') }}</strong>
                        </span>
                    @endif
                  </div>
                </div> -->
                @if(auth()->check())
                    <div class="form-group">
                          <span class="col-md-4"></span>
                          <div class="col-md-5">
                            <input type="submit" class="btn btn-primary pull-right" name="" value="{{ $car->exists ? "Editer" : "Créer" }} la voiture">
                              <!-- <button {{ $mode !== null && $mode === "edit" ? 'disabled' : ''}} type="submit" class="btn btn-primary">
                                  <span>{{ $mode == "edit" ? "Edit" : "Create" }} the car</span>
                              </button> -->
                          </div>
                          <div class="col-md-1">
                              <a href="{{ route("cars.index") }}" class="btn btn-danger pull-right">Annuler</a>
                          </div>
                    </div>
                @endif
              {{ Form::close() }}
                @if($car->exists && auth()->check())
                  @include("partials.comment.create",["route"=>route("cars.comments.store",["car"=>$car])])
                  @each("partials.comment.show",$car->comments,"comment")
                @endif
              {{--<div class="form-group">--}}
                {{--<div class="col-md-6 col-md-offset-4">--}}
                  {{--<button disabled type="submit" class="btn btn-primary">--}}
                    {{--Edit the car--}}
                  {{--</button>--}}
                {{--</div>--}}
              {{--</div>--}}
              @if(auth()->check() && $car->exists)
                <form method="post" action="{{ route("cars.destroy",$car) }}"  class="">
                    <input type="hidden" value="DELETE" name="_method">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    <div class="form-group">
                      <span class="col-md-4"></span>
                      <div class="col-md-6">
                        <input type="submit" id="delete" value="Supprimer la voiture" class="pull-right btn btn-warning">
                      </div>

                    </div>

                </form>
              @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@if(!$car->exists)
  @push("scripts")
  <script type="text/javascript">
    $(document).ready(function(){
      $("input:disabled,select:disabled").removeAttr("disabled");
    });
  </script>
  @endpush
@endif
