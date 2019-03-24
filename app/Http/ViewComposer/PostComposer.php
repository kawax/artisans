<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

use App\Model\Post;

class PostComposer
{
    public function compose(View $view)
    {
        $posts = Post::jobs()->paginate(10, ['*'], 'post');

        $view->with(compact('posts'));
    }
}
