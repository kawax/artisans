<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * UserのOGP画像
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $img = Image::canvas(800, 400, config('artisans.primary'));

        $img->text($user->name, 30, 20, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(50);
            $font->color('#fff');
            $font->valign('top');
        });

        $img->text(Str::of($user->title)->kana('KVa')->wordwrap(12), 30, 100, function ($font) {
            $font->file(config('artisans.font'));
            $font->size(62);
            $font->color('#fff');
            $font->valign('top');
        });

        return $img->response();
    }
}
