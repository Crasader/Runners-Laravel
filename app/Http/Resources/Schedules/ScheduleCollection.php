<?php

namespace App\Http\Resources\Schedules;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Schedules\ScheduleResource;

/**
 * ScheduleCollection
 * Translate Schedule model collection to Json collection
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Users
 */
class ScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ScheduleResource::collection($this->collection);
    }
}
