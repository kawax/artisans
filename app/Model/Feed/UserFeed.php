<?php

namespace App\Model\Feed;

use App\Support\Markdown;
use Spatie\Feed\FeedItem;

trait UserFeed
{
    /**
     * @return array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
                       ->id('user/'.$this->id)
                       ->title($this->title ?? $this->name ?? 'no title')
                       ->summary(Markdown::parse($this->message))
                       ->updated($this->updated_at)
                       ->link(route('user', $this))
                       ->author($this->name);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getFeedItems()
    {
        return cache()->remember('feed.users', now()->addHours(12), function () {
            return self::latest()
                       ->whereHidden(false)
                       ->take(50)
                       ->get();
        });
    }
}
