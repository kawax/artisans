<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Post;

class ConfirmController extends Controller
{
    /**
     * 削除確認
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
        return view('post.confirm')->with(compact('post'));
    }
}
