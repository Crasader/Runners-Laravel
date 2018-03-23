<?php

namespace App\Http\Resources\Groups;

use Illuminate\Http\Resources\Json\Resource;

/**
 * GroupResource
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\groups
 */
class GroupResource extends Resource
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
            'color'        => $this->color,
            'name'         => $this->name
        ];
    }
}
