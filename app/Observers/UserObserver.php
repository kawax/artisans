<?php

namespace App\Observers;

use App\Model\User;

//TODO:通知
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
