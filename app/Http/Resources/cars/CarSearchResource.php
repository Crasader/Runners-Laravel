<?php

namespace App\Http\Resources\cars;

use Illuminate\Http\Resources\Json\Resource;

/**
 * CarSearchResource
 * Resource for search results
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\cars
 */
class CarSearchResource extends Resource
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
            'name' => $this->name
        ];
    }
}
