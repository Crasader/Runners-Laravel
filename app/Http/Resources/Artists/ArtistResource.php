<?php

namespace App\Http\Resources\Artists;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\cartypes\CarTypeResource;
use App\Http\Resources\Comments\CommentCollection;

/**
 * ArtistResource
 * Api ressource
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\Artists
 */
class ArtistResource extends Resource
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
            'name' => $this->name
        ];
    }
}
