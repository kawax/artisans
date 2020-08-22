<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $page = max(1, min(100, $request->input('limit', 20)));

        $posts = Post::search($request->input('q'))
                     ->jobs()
                     ->paginate($page)
                     ->appends('q', $request->input('q'));

        return PostResource::collection($posts);
    }
}
