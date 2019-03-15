<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Model\User;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string                   $name
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $name)
    {
        $user = User::whereName($name)->firstOrFail();

        $img = Image::canvas(640, 480, config('artisans.primary'));

        $img->text($user->name, 20, 10, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(50);
            $font->color('#fff');
            $font->valign('top');
        });

        $img->text(Str::wordwrap($user->title, 10), 20, 100, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(60);
            $font->color('#fff');
            $font->valign('top');
        });

        return $img->response();
    }
}
