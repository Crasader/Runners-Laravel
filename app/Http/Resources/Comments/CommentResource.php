<?php

namespace App\Http\Resources\Comments;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Users\UserResource;

class CommentResource extends Resource
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
            'id'         => $this->id,
            'content'    => $this->content,
            'user'       => new UserResource($this->author),
            'created_at' => $this->created_at ? $this->created_at->toAtomString() : null
        ];
    }
}
