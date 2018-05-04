<?php

namespace App\Http\Resources\waypoints;

use Illuminate\Http\Resources\Json\Resource;

/**
 * WaypointSearchResource
 * Resource for search results
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\waypoints
 */
class WaypointSearchResource extends Resource
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
