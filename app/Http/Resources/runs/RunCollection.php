<?php

namespace App\Http\Resources\runs;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * RunCollection
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\runs
 */
class RunCollection extends ResourceCollection
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
            'data' => RunResource::collection($this->collection),
        ];
    }
}
