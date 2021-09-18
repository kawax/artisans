<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    /**
     * 削除確認
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     *
     * @throws
     */
    public function __invoke(Request $request, Post $post)
    {
        return view('post.confirm')->with(compact('post'));
    }
}
