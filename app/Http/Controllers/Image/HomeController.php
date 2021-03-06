<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * HomeのOGP画像
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $img = Image::canvas(800, 400, config('artisans.primary'));

        $img->text(config('app.name'), 120, 170, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(64);
            $font->color('#fff');
            $font->valign('top');
        });

        return $img->response();
    }
}
