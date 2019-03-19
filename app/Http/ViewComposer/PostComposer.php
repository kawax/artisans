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
        $posts = cache()->remember('posts.all', now()->addDay(), function () {
            return Post::jobs()->get();
        });

        $view->with(compact('posts'));
    }
}
