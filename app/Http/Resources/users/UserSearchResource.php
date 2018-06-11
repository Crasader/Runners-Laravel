<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Resources\Json\Resource;

/**
 * UserSearchResource
 * Resource for search results
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\users
 */
class UserSearchResource extends Resource
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
            'name' => $this->fullname
        ];
    }
}
