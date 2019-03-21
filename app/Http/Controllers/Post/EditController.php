<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Post;

class EditController extends Controller
{
    /**
     * 変更時用のjsonデータ
     *
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post                     $post
     *
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function __invoke(Request $request, Post $post)
    {
        return $post->only([
            'id',
            'title',
            'message',
        ]);
    }
}
