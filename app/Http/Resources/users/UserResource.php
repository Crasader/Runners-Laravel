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
        return [
            // Base user datas to be serialized
            'id'           => $this->id,
            'name'         => $this->name,
            'firstname'    => $this->firstname,
            'lastname'     => $this->lastname,
            'email'        => $this->email,
            'phone_number' => $this->phone_number,
            'sex'          => $this->sex
        ];
    }
}