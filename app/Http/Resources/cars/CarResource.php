<?php

namespace App\Http\Resources\cars;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\cartypes\CarTypeResource;
use App\Http\Resources\Comments\CommentCollection;

/**
 * CarResource
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\cars
 */
class CarResource extends Resource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'plate_number' => $this->plate_number,
            'nb_place'     => $this->type->nb_place,
            'status'       => $this->status,
            'user'         => null, // Actually not implemented (return a user curently driving the car)
            'type'         => new CarTypeResource($this->type),
            'comments'     => $this->has('comments') ? new CommentCollection($this->comments) : null
        ];
    }
}
