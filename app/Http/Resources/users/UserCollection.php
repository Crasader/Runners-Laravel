<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * UserCollection
 * Translate User model collection to Json collection
 *
 * @author Bastien Nicoud
 * @package App\Http\Resources\users
 */
class UserCollection extends ResourceCollection
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
