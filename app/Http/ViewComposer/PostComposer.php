<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

use App\Model\Post;

class PostComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $posts = Post::jobs()->get();

        $view->with(compact('posts'));
    }
}
