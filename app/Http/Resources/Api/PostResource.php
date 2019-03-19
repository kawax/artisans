<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class PostResource extends JsonResource
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
                'title',
                'message',
                'created_at',
                'updated_at',
            ]),
            'user',
            $this->user->only([
                'name',
                'avatar',
            ])
        );
    }
}
