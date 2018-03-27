<?php

namespace App\Http\Resources\cars;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\cartypes\CarTypeResource;

/**
 * CarResource
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\cars
 */
class CarResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->brand . $this->model,
            'plate_number' => $this->plate_number,
            'nb_place'     => $this->type->nb_place,
            'status'       => $this->status,
            'user'         => null, // Actually not implemented (return a user curently driving the car)
            'type'         => new CarTypeResource($this->type)
        ];
    }
}
