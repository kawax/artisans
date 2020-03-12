<?php

namespace App\Providers;

use App\View\Components\Card;
use App\View\Components\Tweet;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive(
            'markdown',
            function ($text) {
                return "<?php echo App\Support\Markdown::parse(${text}); ?>";
            }
        );

        Blade::component(Card::class, 'card');
        Blade::component(Tweet::class, 'tweet');
    }
}
