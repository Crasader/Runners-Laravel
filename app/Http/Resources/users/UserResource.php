<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Resources\Json\Resource;

/**
 * UserResource
 * Translate User model to Json
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\users
 */
class UserResource extends Resource
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
