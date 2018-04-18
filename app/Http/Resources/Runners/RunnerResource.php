<?php

namespace App\Http\Resources\Runners;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\cartypes\CarTypeResource;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\cars\CarResource;

/**
 * UserCollection
 * Translate RunSubscription model to Json resource
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Runners
 */
class RunnerResource extends Resource
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
            'id' => $this->id,
            'run' => $this->run,
            'user' => new UserResource($this->user),
            'vehicle_category' => new CarTypeResource($this->carType),
            'vehicle' => new CarResource($this->car)
        ];
    }
}
