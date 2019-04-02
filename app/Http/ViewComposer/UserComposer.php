<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

use App\Model\User;

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
