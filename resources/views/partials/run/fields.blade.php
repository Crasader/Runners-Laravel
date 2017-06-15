
@push("scripts")
<script>
    window.resource_cache = {!! collect([
         "waypoints"=>$waypoints,
         "car_types"=>$car_types,
         "cars"=>$cars,
         "users"=>$users,
         "subscriptions"=> $run->exists ? $run->subscriptions()->with(["user","car_type","car"])->get() : []
     ]) !!}
</script>
@endpush

{{ Form::bsText("Artist ou nom du run","name",$run->name) }}
{{ Form::bsText("PAX","nb_passenger",$run->nb_passenger) }}

 <div class="form-group required">
     <label for="planned_at" class="col-md-4 control-label">Planifé à</label>
     <div class="col-md-6">
         <input type="hidden" id="input_planned_at" name="planned_at" value="{{ (string)$run->planned_at }}">
         <input type="datetime" class="form-control" id="planned_at" value="{{ (string)$run->planned_at }}">
     </div>
     @if ($errors->has("planned_at"))
         <span class="help-block">
          <strong>{{ $errors->first("planned_at") }}</strong>
      </span>
     @endif
 </div>
<div class="form-group">
    <label for="note" class="col-md-4 control-label">Extra</label>
    <div class="col-md-6">
        <textarea name="note" class="form-control">{{ (string)$run->note }}</textarea>
    </div>
    @if ($errors->has("note"))
        <span class="help-block">
          <strong>{{ $errors->first("note") }}</strong>
      </span>
    @endif
</div>
 @php
     $waypoints = $waypoints->mapWithKeys(function($p){
         return [(string)$p->id => $p->name];
     });
     $car_types = $car_types->mapWithKeys(function($c){
         return [(string)$c->id => $c->name];
     });
     $cars = $cars->mapWithKeys(function($c){
             return [(string)$c->id => $c->name];
     });
     $users = $users->mapWithKeys(function($c){
             return [(string)$c->id => $c->name];
     });
 @endphp

<div id="waypoint-selection" class="waypoints">
    <div class="form-group {{ $run->exists?"":"required" }} {{ $errors->has("waypoints.*") ? 'has-error' : '' }}">
        <div class="col-md-4">
            {{ Form::label("waypoint", "Itinéraire", array('class' => 'control-label col-md-12')) }}
            {{--@if ($errors->has("waypoints.*"))--}}
                {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first("waypoints.*") }}</strong>--}}
                {{--</span>--}}
            {{--@endif--}}
        </div>
    </div>
    @if(!$run->exists)
        @foreach(old("waypoints",[0=>null,1=>null]) as $k => $p)

            @php
                $id = $k."-".str_random(20);
            @endphp
          @if($loop->first)
            <div id="waypoint-first">
                {{--{!! Form::bsSelect("waypoints[]", $waypoints) !!}--}}
                <div class="form-group{{ $errors->has("waypoints.$k") ? ' has-error' : '' }}">
                    <div class="col-md-6 col-md-push-4">
                        <div class="input-group">
                            <input name="waypoints[]" type="text" value="{{ old("waypoints.$k", "") }}" class="form-control waypoint-typeahead" id="{{ $id }}">

                            <div class="input-group-addon" data-input="#{{$id}}" ><span class="glyphicon glyphicon-triangle-bottom"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-push-4 col-md-6">
                    <button style="width:100%" class="btn btn-info" id="add-waypoint">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
            </div>
          @elseif($loop->last)
              <div id="waypoint-last">
                  <div class="form-group{{ $errors->has("waypoints.$k") ? ' has-error' : '' }}">
                      <div class="col-md-6 col-md-push-4">
                          <div class="input-group">
                              {{--{{ Form::text("waypoints[]",old("waypoints.$k", ""), ['class' => 'form-control waypoint-typeahead', "id"=>$id]) }}--}}
                              <input name="waypoints[]" type="text" value="{{ old("waypoints.$k", "") }}" class="form-control waypoint-typeahead" id="{{ $id }}">
                              <div class="input-group-addon" data-input="#{{$id}}" ><span class="glyphicon glyphicon-triangle-bottom" ></span></div>
                          </div>
                      </div>
                  </div>
              </div>
          @else
              <div class="form-group button-remove {{ $errors->has("waypoints.$k") ? 'has-error' : '' }}">
                  <div class="col-md-5 col-md-push-4">
                      <div class="input-group">
                          <input name="waypoints[]" type="text" value="{{ old("waypoints.$k", "") }}" class="form-control waypoint-typeahead" id="{{ $id }}">

                          <div class="input-group-addon" data-input="#{{$id}}" ><span class="glyphicon glyphicon-triangle-bottom" ></span></div>
                      </div>
                  </div>
                  <div class="col-md-1 col-md-push-4">
                      <button class="btn btn-danger" type="button">
                          <span class="glyphicon glyphicon-minus"></span>
                      </button>
                  </div>
              </div>
          @endif
        @endforeach
    @else
        @php
            $points = old("waypoints",$run->waypoints);
            if(!count($points))
                $points = [0=>null,1=>null];
            elseif(count($points)<=1)
              $points = [0 => $run->waypoints()->first(), 1 => null];
            
        @endphp
        @foreach($points as $k => $point)
            @php
                $id = str_random(20);
            @endphp
            @if($loop->first)
                <div id="waypoint-first">
                    <div class="form-group{{ $errors->has("waypoint.$k") ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-push-4">
                            <div class="input-group">
                                <input name="waypoints[]" type="text" value="{{ old("waypoints.".$k, is_object($point) ? $point->name : $point) }}" class="form-control waypoint-typeahead" id="{{ $id }}">
                                <div class="input-group-addon" data-input="#{{$id}}" ><span class="glyphicon glyphicon-triangle-bottom"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-push-4 col-md-6 col-xs-12">
                            <button type="button" style="width:100%" class="btn btn-info" id="add-waypoint">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
            @elseif($loop->last)
                <div id="waypoint-last">
                    <div class="form-group{{ $errors->has("waypoints.$k") ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-push-4">
                            <div class="input-group">
                                <input name="waypoints[]" type="text" value="{{ old("waypoints.".$k, is_object($point) ? $point->name : $point) }}" class="form-control waypoint-typeahead" id="{{ $id }}">
                                <div class="input-group-addon" data-input="#{{$id}}" ><span class="glyphicon glyphicon-triangle-bottom"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group button-remove {{ $errors->has("waypoints.$k") ? 'has-error' : '' }}">
                    <div class="col-md-5 col-md-push-4">
                        <div class="input-group">
{{--                            {{ Form::text("waypoints[]",old("waypoints.".is_object($point) ? $point->pivot->order : $k, is_object($point) ? $point->name : $point), ['class' => 'form-control waypoint-typeahead', "id"=>$id]) }}--}}
                            <input name="waypoints[]" type="text" value="{{ old("waypoints.".$k, is_object($point) ? $point->name : $point) }}" class="form-control waypoint-typeahead" id="{{ $id }}">
                            <div class="input-group-addon" data-input="#{{$id}}" ><span class="glyphicon glyphicon-triangle-bottom"  ></span></div>
                        </div>
                    </div>
                    <div class="col-md-1 col-md-push-4">
                        <button class="btn btn-danger" type="button">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>




<div id="subs-container">
    <div class="form-group {{ $errors->has("subscriptions") ? ' has-error' : '' }}">
        <div class="">
            {{ Form::label("subscriptions", ucfirst("Convois"), array('class' => 'control-label col-md-4')) }}
            @if ($errors->has("subscriptions"))
                <span class="help-block">
                        <strong>{{ $errors->first("subscriptions") }}</strong>
                    </span>
            @endif
        </div>

    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-push-4">
            <button style="width:100%" class="btn btn-info" id="add-sub" type="button">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
    </div>
    <div id="subs" class="subs" ></div>
</div>

 @push("styles")
 <link rel="stylesheet" href="{{ asset("css/jquery-ui.min.css")}}">
 <link rel="stylesheet" href="{{ asset("css/jquery-ui-timepicker-addon.min.css")}}">
 @endpush

@push("scripts")
<script src="{{ asset("js/jquery-ui.min.js")}}"></script>
<script src="{{ asset("js/jquery-ui-timepicker-addon.min.js")}}"></script>
<script src="{{ asset("js/jquery-ui-timepicker-fr.js")}}"></script>
 <script src="{{ asset("/js/typeahead.js") }}" charset="utf-8"></script>

<script type="text/javascript">
//waypoint autocomplete combobox

var suggestions = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.nickname) },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          identify: function(obj) { return obj.nickname; },
          sufficient: 1,
          local: window.resource_cache.waypoints.map(p => {
              return {
              nickname: p.name,
              geocoder: p.geo,
              id: p.id
            }
          }),
          remote: {
            url: `http://${window.location.hostname}/api/waypoints/search?q=%QUERY&token=${window.Laravel.token}`,
            wildcard:"%QUERY"
          }
        });
function searchWithDefaults(q, sync) {
  if (q === '') {
    sync(suggestions.index.all());
  } else {
    suggestions.search(q, sync);
  }
}
window.typeaheadOpened = {}//stores the corresponcance between all typeahead instances that are opened
//it looks somethinf like, true means open, false means closed. If undefined need to assign it
/*
* {
*   #idOfInput: true
*   #idOfInput: false
 *}
*/
document.querySelectorAll("[data-input]").forEach(i => {
    i.addEventListener("click", e => {
        e.preventDefault()
        console.log(i.dataset.input)
        toggleWaypointInput(i)

    })
})
function code(e) {
    e = e || window.event;
    return(e.keyCode || e.which);
}
document.addEventListener("keypress", (e)=>{
  if(code(e) == 27){
    document.querySelectorAll(".waypoint-typeahead").forEach(i => $(i).typeahead("close"))
  }
})
function toggleWaypointInput(input){
  // console.log($(input.dataset.input).typeahead("open"))
  console.log(typeaheadOpened)
  if(typeof typeaheadOpened[input.dataset.input] == "undefined" || !typeaheadOpened[input.dataset.input]){
      $(`${input.dataset.input}`).typeahead('open')
      typeaheadOpened[input.dataset.input] = true
  }
  else{
      $(`${input.dataset.input}`).typeahead('close')
      typeaheadOpened[input.dataset.input] = false
  }
}
suggestions.initialize()
const suggestionConfig = {
    name: 'suggestions',
    displayKey: 'nickname',
    source: suggestions.ttAdapter()//searchWithDefaults
}
const typeaheadConfig = {
    hint: true,
    highlight: true,
    minLength: 1
}

$(".waypoint-typeahead").typeahead(typeaheadConfig,suggestionConfig);


function bindTypeaheadEvents(){
  $(".waypoint-typeahead.tt-input").on('typeahead:open', function() {
      typeaheadOpened[`#${$(this).attr('id')}`] = true
      return true
  });
  $(".waypoint-typeahead.tt-input").on('typeahead:close', function() {
      typeaheadOpened[`#${$(this).attr('id')}`] = false
      return true
  });
}
bindTypeaheadEvents()
//--------------------------------------------------------------------
// picker pour la date des runs
$( function() {

  $( "#planned_at" ).datetimepicker({
      controlType: 'select',
      oneLine: true,
      altField: "#input_planned_at",
      altFieldTimeOnly: false,
    	altFormat: "yy-mm-dd",
    	altTimeFormat: "hh:mm:ss",
      timeFormat:"hh:mm",
      secondSlider:false,
      showSecond:false,
      dateFormat: 'dd/mm',
  });
  $( "#planned_at" ).datetimepicker('setDate', new Date($( "#planned_at" ).val())  );

} );
// _______________________________
document.querySelectorAll(".button-remove").forEach(function(container){
    var b = container.getElementsByTagName("button")[0]
    b.addEventListener("click",function(e){
        e.preventDefault()
        container.parentNode.removeChild(container)
    })
})
var add = document.getElementById("add-waypoint")
add.addEventListener("click",function(e){
    e.preventDefault()
    var select = document.createElement("input")
    select.name = "waypoints[]"
    select.classList.add("waypoint-typeahead")
    select.classList.add("form-control")
    select.type="text"
    select.id = "waypoint-typeahead-"+Math.ceil(Math.random()*100000)
    // for(var p in waypoints)
    // {
    //     console.log(p)
    //     var opt = document.createElement('option');
    //     var id = p//Object.keys(p)[0]
    //     opt.value= id
    //     opt.innerHTML = waypoints[p]
    //     select.appendChild(opt)
    // }
    var last = document.getElementById("waypoint-last")
    var container = document.createElement("div")
    container.classList.add("form-group")
    var subContainer = document.createElement("div")
    subContainer.classList.add("col-md-5")
    subContainer.classList.add("col-md-push-4")

    var inputGroup = document.createElement("div")
    inputGroup.classList.add("input-group")
    inputGroup.appendChild(select)
    var btnTypeahead = document.createElement("div")
    btnTypeahead.classList.add("input-group-addon")

    var icon = document.createElement("span")
    icon.classList.add("glyphicon")
    icon.classList.add("glyphicon-triangle-bottom")

    btnTypeahead.dataset.input="#"+select.id
    btnTypeahead.addEventListener("click", e => {
      e.preventDefault()
      toggleWaypointInput(btnTypeahead)
    })
    btnTypeahead.appendChild(icon)
    inputGroup.appendChild(btnTypeahead)

    subContainer.appendChild(inputGroup)

    var btn = document.createElement("button")
    btn.classList.add("btn")
    btn.classList.add("btn-danger")
    btn.type="button"


    var iconDelete = document.createElement("span")
    iconDelete.classList.add("glyphicon")
    iconDelete.classList.add("glyphicon-minus")
    btn.appendChild(iconDelete)

    btn.addEventListener("click",function(e){
        e.preventDefault();
        document.getElementById("waypoint-selection").removeChild(container)
    })
    var btnContainer = document.createElement("div")
    btnContainer.classList.add("col-md-1")
    btnContainer.classList.add("col-md-push-4")
    btnContainer.appendChild(btn)
    container.appendChild(subContainer)
    container.appendChild(btnContainer)
    document.getElementById("waypoint-selection").insertBefore(container,document.getElementById("waypoint-last"))


    $(select).typeahead(typeaheadConfig,suggestionConfig);
    bindTypeaheadEvents();
})


const generateSubscription = (sub) => {
    console.log(sub)
    var cars = window.resource_cache.cars
    var car_types = window.resource_cache.car_types
    var runners = window.resource_cache.users

    var container = document.createElement("div")
    var hasCarType = sub.car_type ? true:false
    var hasCar = sub.car ? true:false
    var hasRunner = sub.user ? true:false

    var car = sub.car
    var user = sub.user
    var ctype = sub.car_type

    var cars_input = document.createElement("select")
    var cars_container = document.createElement("div")

    var runners_input = document.createElement("select")
    var runners_container = document.createElement("div")

    var car_types_input = document.createElement("select")
    var car_types_container = document.createElement("div")

    var id_input = document.createElement("input")
    id_input.type = "hidden"
    id_input.value = sub.id ? sub.id : null

    var emptyOption = document.createElement("option")
    emptyOption.value=-1
    emptyOption.text=" "

    var delete_btn = document.createElement("button")
    delete_btn.innerHTML="<span class='glyphicon glyphicon-minus'></span>"
    delete_btn.type = "button"

    // var reset_btn = document.createElement("button")
    // reset_btn.innerHTML="<span class='glyphicon glyphicon-repeat'></span>"
    // reset_btn.type = "button"

    var btn_container = document.createElement("div")

    btn_container.appendChild(delete_btn)
    // btn_container.appendChild(reset_btn)
    //these classes with show only the cars_type_input
    //- container stuff
    container.classList.add("row")
    //-inputs positioning
    car_types_container.classList.add("col-md-5")
    car_types_container.classList.add("col-md-push-4")
    runners_container.classList.add("col-md-2")
    runners_container.classList.add("col-md-push-4")
    cars_container.classList.add("col-md-2")
    cars_container.classList.add("col-md-push-4")
    btn_container.classList.add("col-md-1")
    btn_container.classList.add("col-md-push-4")
    //car_types_container.classList.add("col-md-11")
    //- hide elements that can't be visible at first
    cars_container.classList.add("hidden")
    runners_container.classList.add("hidden")
    // reset_btn.classList.add("hidden")

    // reset_btn.classList.add("btn")
    // reset_btn.classList.add("btn-default")
    delete_btn.classList.add("btn")
    delete_btn.classList.add("btn-danger")
    car_types_input.classList.add("form-control")
    cars_input.classList.add("form-control")
    runners_input.classList.add("form-control")

    //reset some of the classes if the sub has a car type
    if(hasCarType){
        //set the other inputs visible
        car_types_container.classList.toggle("col-md-5")
        car_types_container.classList.toggle("col-md-2")
        cars_container.classList.toggle("hidden")
        runners_container.classList.toggle("hidden")
        // reset_btn.classList.toggle("hidden")
    }
    //add options
    cars_input.add(emptyOption.cloneNode())
    car_types_input.add(emptyOption.cloneNode())
    runners_input.add(emptyOption.cloneNode())
    car_types.map((ct)=>{
        var option = document.createElement("option")
        option.text = ct.name
        option.value = ct.id
        car_types_input.add(option)
    })
    runners.map((u)=>{
        var option = document.createElement("option")
        option.text = u.name
        option.value = u.id
        runners_input.add(option)
    })

    //set the cars
    if(hasCarType){
        car_types_input.value = ctype.id
        cars_input.innerHTML = ""
        cars_input.add(emptyOption)
        cars.filter( c => c.car_type_id == ctype.id).forEach( (c) => {
            var option = document.createElement("option")
            option.text = c.name //+ " (" + c.nb_place + ")"
            option.value = c.id
            cars_input.add(option)
        })
    }
    if(hasRunner)
        runners_input.value = user.id
    if(hasCar)
        cars_input.value = car.id
    //set names for inputs
    let count = document.querySelector("#subs").children.length
    cars_input.name="subscriptions["+count+"][car]"
    runners_input.name = "subscriptions["+count+"][user]"
    car_types_input.name = "subscriptions["+count+"][car_type]"
    id_input.name = "subscriptions["+count+"][id]"

    //EVENT HANDLING
    /*reset_btn.addEventListener("click", (e)=>{
        e.preventDefault()
        cars_input.innerHTML = ""
        cars_input.add(emptyOption)
        cars_input.value = -1
        car_types_input.value = -1
        runners_input.value = -1
        //show only the car

        car_types_container.classList.toggle("col-md-5")
        car_types_container.classList.toggle("col-md-2")
        cars_container.classList.toggle("hidden")
        runners_container.classList.toggle("hidden")
        //delete_btn.classList.toggle("hidden")
        reset_btn.classList.toggle("hidden")
    })*/

    delete_btn.addEventListener("click",(e)=>{
        e.preventDefault()
        container.parentNode.removeChild(container)
    })

    car_types_input.addEventListener("change",(e) => {
        var type = e.target.value && e.target.value != -1 ? e.target.value : false
        if(type != false){
            cars_input.innerHTML = "" //reset the cars
            cars_input.add(emptyOption)
            console.log(cars)
            cars.filter( c => c.car_type_id == type).forEach( (c) => {
                var option = document.createElement("option")
                option.text = c.name //+ " (" + c.nb_place + ")"
                option.value = c.id
                cars_input.add(option)
            })
            //SET VISIBLE
            //maybe it's already visible
            if(car_types_container.classList.contains("col-md-5")){
                car_types_container.classList.toggle("col-md-5")
                car_types_container.classList.toggle("col-md-2")
                cars_container.classList.toggle("hidden")
                runners_container.classList.toggle("hidden")
                // reset_btn.classList.toggle("hidden")
            }

        //TODO set other inputs to show
        }
        else{
            cars_input.innerHTML = ""
            cars_input.add(emptyOption)
            cars_input.value = -1
            //we can't do anything if there is a user
            if(runners_input.value == -1){
                //reset the car_type input to full size
                //set other inputs hidden
                car_types_container.classList.toggle("col-md-5")
                car_types_container.classList.toggle("col-md-2")
                cars_container.classList.toggle("hidden")
                runners_container.classList.toggle("hidden")
                // reset_btn.classList.toggle("hidden")

            }
        }
    })
    runners_input.addEventListener("change", (e)=>{
        var user = e.target.value && e.target.value != -1 ? e.target.value : false
        if(user){
            return false
        }
        else{
            if(car_types_input.value == -1){
                cars_input.value = -1

                car_types_container.classList.toggle("col-md-5")
                car_types_container.classList.toggle("col-md-2")
                cars_container.classList.toggle("hidden")
                runners_container.classList.toggle("hidden")
                // reset_btn.classList.toggle("hidden")
            }
        }
    })
    car_types_container.appendChild(car_types_input)
    runners_container.appendChild(runners_input)
    cars_container.appendChild(cars_input)


    container.appendChild(car_types_container)
    container.appendChild(cars_container)
    container.appendChild(runners_container)

    container.appendChild(id_input)
    container.appendChild(btn_container)


    return container

}
var subs = document.querySelector("#subs")
var add_sub = document.querySelector("#add-sub")
add_sub.addEventListener("click",(e)=>{
    e.preventDefault()
    subs.appendChild(generateSubscription({car_type:null,car:null,user:null}))
})
var data = window.resource_cache.subscriptions
data.forEach((s)=> subs.appendChild(generateSubscription(s)))

</script>
@endpush

@push("scripts")
<script type="text/javascript">
 $(document).ready(function(){
     $("input:disabled,select:disabled").removeAttr("disabled");
 });
</script>
@endpush

 @push("styles")
 <style>
     .ui-widget.ui-widget-content{
         z-index: 2 !important;
     }
     .waypoints .form-group{
         margin-bottom: 0px !important;
     }
     #waypoint-first{
         margin-bottom: 15px;
     }
     #waypoint-last{
         margin-top:15px;
     }
 </style>
 @endpush
