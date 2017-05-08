<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lib\Models\Car;
use Lib\Models\CarType;
use Lib\Models\User;
use Lib\Models\Waypoint;

class CreateRunRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=>"required|min:1",
            "nb_passenger"=>"required|numeric|max:50",
//            "note"=>"sometimes|min:1",
            "planned_at"=>"required|date",
            "waypoints"=>"required|min:2",
            "subscriptions"=>"sometimes|required|min:1"
            //"waypoints.*"=>Rule::in(Waypoint::all()->pluck("id")->toArray()),
        ];
    }
    public function messages()
    {
      return [
        "waypoints.in"=>"Could not find waypoints ".collect($this->get("waypoints")),
//        "car_types.in"=>"Could not find car types ".collect($this->get("convoy.*.car_types")),
//        "cars.in"=>"Could not find cars ".collect($this->get("convoys.*.cars")),
//        "runners.in"=>"Could not find drivers ".collect($this->get("convoys.*.user"))
      ];
    }
}
