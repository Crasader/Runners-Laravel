<?php

namespace App\Http\Resources\Schedules;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Groups\GroupResource;

/**
 * ScheduleResource
 * Translate Schedule model to Json
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Shedules
 */
class ScheduleResource extends Resource
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
            'start_time' => $this->start_time,
            'end_time'   => $this->end_time,
            'group'      => new GroupResource($this->group)
        ];
    }
}
