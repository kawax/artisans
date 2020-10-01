<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * PostのOGP画像
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        $img = Image::canvas(800, 400, config('artisans.primary'));

        $img->rectangle(5, 5, 795, 395, function ($draw) {
            $draw->background('#fff');
        });

        $img->text(Str::of($post->title)->kana('KVa')->wordwrap(12), 30, 20, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(62);
            $font->color(config('artisans.primary'));
            $font->valign('top');
        });

        return $img->response();
    }
}
