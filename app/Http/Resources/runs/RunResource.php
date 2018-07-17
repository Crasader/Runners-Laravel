<?php

namespace App\Http\Resources\runs;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\waypoints\WaypointCollection;
use App\Http\Resources\Runners\RunnerCollection;

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
            'id'           => $this->id,
            'status'       => $this->status,
            'title'        => $this->name,
            'begin_at'     => $this->planned_at ? $this->planned_at->toAtomString() : null,
            'start_at'     => $this->started_at ? $this->started_at->toAtomString() : null,
            'tbc'          => $this->tbc,
            'end_at'       => $this->ended_at ? $this->ended_at->toAtomString() : null,
            'finished_at'  => $this->end_planned_at ? $this->end_planned_at->toAtomString() : null,
            'nb_passenger' => $this->passengers,
            'runinfo'      => $this->infos,
            'waypoints'    => new WaypointCollection($this->waypoints),
            'runners'      => new RunnerCollection($this->subscriptions)
        ];
    }
}
