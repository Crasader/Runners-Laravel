<?php

namespace App\Http\Resources\cartypes;

use Illuminate\Http\Resources\Json\Resource;

/**
 * CarTypeSearchResource
 * Resource for search results
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\cartypes
 */
class CarTypeSearchResource extends Resource
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
