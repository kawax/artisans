<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Post;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post                      $post
     *
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function __invoke(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        return $post->only([
            'id',
            'title',
            'message',
        ]);
    }
}
