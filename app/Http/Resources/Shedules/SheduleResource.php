<?php

namespace App\Http\Resources\Shedules;

use Illuminate\Http\Resources\Json\Resource;

/**
 * SheduleResource
 * Translate Shedule model to Json
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Shedules
 */
class SheduleResource extends Resource
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
