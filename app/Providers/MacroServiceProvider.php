<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('wordwrap', function ($str, $width = 10, $break = PHP_EOL) {
            $str = mb_convert_kana($str, 'a');

            $length = mb_strlen($str);
            $arr = [];
            for ($i = 0; $i <= $length; $i += $width) {
                $arr[] = mb_substr($str, $i, $width);
            }

            return implode($break, $arr);
        });
    }
}
