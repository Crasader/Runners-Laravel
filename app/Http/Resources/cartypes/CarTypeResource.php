<?php

namespace App\Http\Resources\cartypes;

use Illuminate\Http\Resources\Json\Resource;

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
            'name' => $this->name,
            'description' => $this->description,
          ];
    }
}
