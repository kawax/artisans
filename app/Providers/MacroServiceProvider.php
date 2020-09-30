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
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro(
            'wordwrap',
            function ($str, $width = 10, $break = PHP_EOL) {
                $arr = Str::of(mb_convert_kana($str, 'KVa'))
                          ->split('/\B/u')
                          ->chunk($width)
                          ->mapSpread(
                              function (...$strings) {
                                  $collect = collect($strings);
                                  $collect->pop();

                                  return $collect->implode('');
                              }
                          );

                return $arr->implode($break);
            }
        );
    }
}
