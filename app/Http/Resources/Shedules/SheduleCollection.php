<?php

namespace App\Http\Resources\Shedules;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * SheduleCollection
 * Translate Shedule model collection to Json collection
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Users
 */
class SheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
