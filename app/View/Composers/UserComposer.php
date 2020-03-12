<?php

namespace App\View\Composers;

use App\Model\User;
use Illuminate\View\View;

class UserComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        //$users = User::artisans();
        $users = User::inRandomOrder()
                     ->whereHidden(false)
                     ->with('tags')
                     ->get();

        $view->with(compact('users'));
    }
}
