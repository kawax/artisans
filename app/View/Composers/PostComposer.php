<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class PostComposer
{
    public function compose(View $view)
    {
        $posts = Post::articles()->paginate(10, ['*'], 'post');

        $view->with(compact('posts'));
    }
}
