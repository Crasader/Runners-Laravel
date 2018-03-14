<?php

namespace App\Http\Resources\Groups;

use Illuminate\Http\Resources\Json\Resource;

/**
 * GroupResource
 * Translate Group model to Json
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Groups
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
            // Base user datas to be serialized
            'id'         => $this->id,
            'color'      => $this->color,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
