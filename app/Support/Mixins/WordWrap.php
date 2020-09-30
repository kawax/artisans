<?php

namespace App\Support\Mixins;

use Illuminate\Support\Str;

class WordWrap
{
    /**
     * @param  string  $str
     * @param  int  $width
     * @param  string  $break
     *
     * @return callable
     */
    public function wordwrap()
    {
        return function (string $str, int $width = 10, string $break = PHP_EOL) {
            return Str::of($str)
                ->kana('KVa')
                ->split('/\B/u')
                ->chunk($width)
                ->mapSpread(function (...$strings) {
                    return tap(collect($strings))->pop()->implode('');
                })->implode($break);
        };
    }
}
