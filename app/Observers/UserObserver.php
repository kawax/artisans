<?php

namespace App\Observers;

use Illuminate\Support\Facades\Notification;

use App\Model\User;
use App\Notifications\UserNotification;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Model\User $user
     *
     * @return void
     */
    public function created(User $user)
    {
        info('created', $user->toArray());

        Notification::route('discord', config('services.discord.channel.user'))
                    ->route('slack', config('services.slack.user'))
                    ->notify((new UserNotification($user, 'created'))->delay(now()->addMinutes(10)));
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Model\User $user
     *
     * @return void
     */
    public function updated(User $user)
    {
        info('updated', $user->toArray());

        //        Notification::route('discord', config('services.discord.channel.user'))
        //                    ->route('slack', config('services.slack.user'))
        //                    ->notify(new UserNotification($user, 'updated'));
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Model\User $user
     *
     * @return void
     */
    public function deleted(User $user)
    {
        info('deleted', $user->toArray());
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Model\User $user
     *
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Model\User $user
     *
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
