<?php

namespace App\Http\Resources\waypoints;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * WaypointCollection
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\waypoints
 */
class WaypointCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => WaypointResource::collection($this->collection),
        ];
    }
}
