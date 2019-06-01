<?php

namespace App\Http\Resources\Profile;

use Illuminate\Support\Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return Arr::add(
            parent::toArray($request),
            'tags',
            $this->tags()->pluck('tag')
        );
    }
}
