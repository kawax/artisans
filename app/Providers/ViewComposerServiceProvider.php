<?php

namespace App\Providers;

use App\View\Composers\PostComposer;
use App\View\Composers\UserComposer;
use Illuminate\Support\ServiceProvider;

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
            'post.posts',
            PostComposer::class
        );

        view()->composer(
            ['home', 'user.index'],
            UserComposer::class
        );
    }
}
