<?php

namespace App\Http\Resources\waypoints;

use Illuminate\Http\Resources\Json\Resource;

/**
 * WaypointResource
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\waypoints
 */
class WaypointResource extends Resource
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
            'name'         => $this->name,
            'order'        => $this->pivot->order,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ];
    }
}
