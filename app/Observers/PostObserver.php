<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;

use App\Model\Post;
use App\Notifications\PostNotification;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Model\Post $post
     *
     * @return void
     */
    public function created(Post $post)
    {
        Notification::route('discord', config('services.discord.channel.post'))
                    ->route('slack', config('services.slack.post'))
                    ->notify(new PostNotification($post, 'created'));
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Model\Post $post
     *
     * @return void
     */
    public function updated(Post $post)
    {
        Notification::route('discord', config('services.discord.channel.post'))
                    ->route('slack', config('services.slack.post'))
                    ->notify(new PostNotification($post, 'updated'));
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Model\Post $post
     *
     * @return void
     */
    public function deleted(Post $post)
    {
        info('deleted', $post->toArray());
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Model\Post $post
     *
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Model\Post $post
     *
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
