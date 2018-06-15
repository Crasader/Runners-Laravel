<?php

namespace App\Http\Resources\Schedules;

use Illuminate\Http\Resources\Json\Resource;

/**
 * CalendarFormatScheduleResource
 * Translate Schedule model to Json, with special formating to be used
 * with the fullcalendar integration (in schedule page)
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Shedules
 */
class CalendarFormatScheduleResource extends Resource
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
            'id'         => $this->id,
            'title'      => $this->group->name,
            'start'      => $this->start_time->toIso8601String(),
            'end'        => $this->end_time->toIso8601String(),
            'color'      => '#' . $this->group->color,
            'show_route' => route('schedules.show', ['schedule' => $this->id])
        ];
    }
}
