<?php

namespace App\Observers;

use App\Models\Post;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\Notification;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  Post  $post
     * @return void
     * @throws \Exception
     */
    public function created(Post $post)
    {
        cache()->forget('feed.posts');

        Notification::route('discord', config('services.discord.channel.post'))
                    ->route('slack', config('services.slack.post'))
                    ->notify(new PostNotification($post, 'created'));
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  Post  $post
     * @return void
     * @throws \Exception
     */
    public function updated(Post $post)
    {
        cache()->forget('feed.posts');

        Notification::route('discord', config('services.discord.channel.post'))
                    ->route('slack', config('services.slack.post'))
                    ->notify((new PostNotification($post, 'updated'))->delay(now()->addMinutes(5)));
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  Post  $post
     * @return void
     * @throws \Exception
     */
    public function deleted(Post $post)
    {
        cache()->forget('feed.posts');

        Notification::route('discord', config('services.discord.channel.post'))
                    ->route('slack', config('services.slack.post'))
                    ->notify((new PostNotification($post, 'deleted'))->delay(now()->addMinutes(5)));
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
