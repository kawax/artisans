<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return Arr::add(
            Arr::only(parent::toArray($request), [
                'id',
                'name',
                'avatar',
                'title',
                'message',
                'updated_at',
            ]),
            'tags',
            $this->tags()->pluck('tag')
        );
    }
}
