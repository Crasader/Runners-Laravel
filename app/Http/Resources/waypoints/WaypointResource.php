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
            'nickname'     => $this->name
        ];
    }
}
