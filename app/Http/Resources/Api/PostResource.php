<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\MarkDown;

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
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'message'    => Markdown::parse($this->message)->toHtml(),
            'url'        => route('post.show', $this),
            'image'      => route('image.post', $this),
            'user'       => $this->user->only([
                'name',
                'avatar',
            ]),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
