<?php

namespace App\Observers;

use App\Model\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  User  $user
     * @return void
     * @throws \Exception
     */
    public function created(User $user)
    {
        //info('created', $user->toArray());

        cache()->forget('feed.users');

        Notification::route('discord', config('services.discord.channel.user'))
                    ->route('slack', config('services.slack.user'))
                    ->notify((new UserNotification($user, 'created'))->delay(now()->addMinutes(5)));
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  User  $user
     * @return void
     * @throws \Exception
     */
    public function updated(User $user)
    {
        //info('updated', $user->toArray());

        cache()->forget('feed.users');

        Notification::route('discord', config('services.discord.channel.user'))
                    ->route('slack', config('services.slack.user'))
                    ->notify((new UserNotification($user, 'updated'))->delay(now()->addMinutes(5)));
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  User  $user
     * @return void
     * @throws \Exception
     */
    public function deleted(User $user)
    {
        info('deleted', $user->toArray());

        cache()->forget('feed.users');
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
