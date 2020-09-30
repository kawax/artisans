<?php

namespace App\Providers;

use App\Support\Mixins\Japanese;
use App\Support\Mixins\Kana;
use App\Support\Mixins\WordWrap;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Str::mixin(new WordWrap());

        Str::mixin(new Kana());

        Stringable::mixin(new Japanese());
    }
}
