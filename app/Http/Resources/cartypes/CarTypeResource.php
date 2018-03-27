<?php

namespace App\Http\Resources\cartypes;

use Illuminate\Http\Resources\Json\Resource;

/**
 * CarTypeResource
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\cartypes
 */
class CarTypeResource extends Resource
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
            'type'        => $this->name,
            'description' => $this->description
        ];
    }
}
