<?php

namespace App\Http\Resources\cars;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * CarCollection
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\cars
 */
class CarCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return CarResource::collection($this->collection);
    }
}
