<?php

namespace App\Http\Resources\Runners;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Runners\RunnerResource;

/**
 * UserCollection
 * Translate RunSubscription model collection to Json collection
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Runners
 */
class RunnerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return RunnerResource::collection($this->collection);
    }
}
