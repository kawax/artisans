<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposer\PostComposer;
use App\Http\ViewComposer\UserComposer;
use App\Http\ViewComposer\StarterComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'home.posts',
            PostComposer::class
        );

        view()->composer(
            'user.index',
            UserComposer::class
        );

        view()->composer(
            'starter',
            StarterComposer::class
        );
    }
}
