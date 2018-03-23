<?php

namespace App\Http\Resources\groups;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * GroupCollection
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\groups
 */
class GroupCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return GroupResource::collection($this->collection);
    }
}
