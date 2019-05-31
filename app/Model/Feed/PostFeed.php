<?php

namespace App\Model\Feed;

use Spatie\Feed\FeedItem;
use App\Support\Markdown;

trait PostFeed
{
    /**
     * @return array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
                       ->id('post/' . $this->id)
                       ->title($this->title ?? 'no title')
                       ->summary(Markdown::parse($this->message))
                       ->updated($this->updated_at)
                       ->link(route('post.show', $this))
                       ->author($this->user->name);
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
