<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

use App\Model\User;

class StarterComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user_count = User::count();

        $view->with(compact('user_count'));
    }
}
