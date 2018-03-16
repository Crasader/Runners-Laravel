<?php

namespace App\Http\Resources\runs;

use Illuminate\Http\Resources\Json\Resource;

/**
 * RunResource
 * Api ressource
 *
 * @author Nicolas Henry
 * @package App\Http\Resources\runs
 */
class RunResource extends Resource
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
            'name'           => $this->name,
            'status'         => $this->status,
            'published_at'   => $this->published_at,
            'planned_at'     => $this->planned_at,
            'end_planned_at' => $this->end_planned_at,
            'started_at'     => $this->started_at,
            'ended_at'       => $this->ended_at,
            'passengers'     => $this->passengers,
            'deleted_at'     => $this->deleted_at,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at
        ];
    }
}
