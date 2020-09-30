<?php

namespace App\Support\Mixins;

use Illuminate\Support\Str;

class Japanese
{
    /**
     * mb_convert_kana()
     *
     * @param  string  $option
     * @param  string  $encoding
     *
     * @return callable
     */
    public function kana()
    {
        return function (string $option = 'KV', string $encoding = null) {
            return new static(Str::kana($this->value, $option, $encoding));
        };
    }
}
