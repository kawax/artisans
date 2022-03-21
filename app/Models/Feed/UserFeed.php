<?php

namespace App\Models\Feed;

use App\Support\Markdown;
use Spatie\Feed\FeedItem;

trait UserFeed
{
    /**
     * @return FeedItem
     */
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id('user/'.$this->id)
            ->title($this->title ?? $this->name ?? 'no title')
            ->summary(Markdown::parse($this->message))
            ->updated($this->updated_at)
            ->link(route('user', $this))
            ->authorName($this->name);
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public static function getFeedItems()
    {
        return cache()->remember('feed.users',
            now()->addHours(12),
            fn () => self::latest()
                ->whereHidden(false)
                ->take(50)
                ->get());
    }
}
