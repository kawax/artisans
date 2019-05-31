<?php

namespace App\Http\Resources\Api;

use App\Support\Markdown;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'avatar'     => $this->avatar,
            'title'      => $this->title,
            'message'    => Markdown::parse($this->message)->toHtml(),
            'url'        => route('user', $this),
            'image'      => route('image.user', $this),
            'tags'       => $this->tags()->pluck('tag'),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
