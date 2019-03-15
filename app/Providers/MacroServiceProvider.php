<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Str;

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
            $c = mb_strlen($str);
            $arr = [];
            for ($i = 0; $i <= $c; $i += $width) {
                $arr[] = mb_substr($str, $i, $width);
            }

            return implode($break, $arr);
        });
    }
}
