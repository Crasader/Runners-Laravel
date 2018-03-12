<?php

namespace App\Http\Resources\Schedules;

use Illuminate\Http\Resources\Json\Resource;

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
        return parent::toArray($request);
    }
}
