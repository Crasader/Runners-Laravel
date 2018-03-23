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
            'plate_number' => $this->plate_number,
            'brand'        => $this->brand,
            'model'        => $this->model,
            'color'        => $this->color,
            'status'       => $this->status,
            'type'         => new CarTypeResource($this->type)
        ];
    }
}
