<?php

namespace App\Http\Resources\cartypes;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * CarTypeController
 * Api ressource controller
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\cartypes
 */
class CarTypeCollection extends ResourceCollection
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
            'data' => CarTypeResource::collection($this->collection),
        ];
    }
}
