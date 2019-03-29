<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use App\Model\Post;

class PostController extends Controller
{
    /**
     * PostのOGP画像
     *
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  Post     $post
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        $img = Image::canvas(800, 400, config('artisans.primary'));

        $img->rectangle(5, 5, 795, 395, function ($draw) {
            $draw->background('#fff');
        });

        $img->text(Str::wordwrap($post->title, 12), 30, 20, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(62);
            $font->color(config('artisans.primary'));
            $font->valign('top');
        });

        return $img->response();
    }
}
