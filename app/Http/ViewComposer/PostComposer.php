<?php

namespace App\Http\ViewComposer;

use App\Model\Post;
use Illuminate\View\View;

class PostComposer
{
    public function compose(View $view)
    {
        $posts = Post::jobs()->paginate(10, ['*'], 'post');

        $view->with(compact('posts'));
    }
}
