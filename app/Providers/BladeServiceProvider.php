<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
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
        Blade::directive('markdown', function ($text) {
            return "<?php echo App\Support\Markdown::parse($text); ?>";
        });

        Blade::component('components.card', 'card');
        Blade::component('components.tweet', 'tweet');
    }
}
