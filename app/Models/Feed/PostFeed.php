<?php

namespace App\Models\Feed;

use App\Support\Markdown;
use Spatie\Feed\FeedItem;

trait PostFeed
{
    /**
     * @return FeedItem
     */
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
                       ->id('post/'.$this->id)
                       ->title($this->title ?? 'no title')
                       ->summary(Markdown::parse($this->message))
                       ->updated($this->updated_at)
                       ->link(route('post.show', $this))
                       ->authorName($this->user->name);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getFeedItems()
    {
        return cache()->remember('feed.posts', now()->addHours(12), function () {
            return self::latest()
                       ->with('user')
                       ->take(50)
                       ->get();
        });
    }
}
