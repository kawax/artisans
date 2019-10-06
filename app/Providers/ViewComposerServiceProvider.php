<?php

namespace App\Providers;

use App\Http\ViewComposer\PostComposer;
use App\Http\ViewComposer\UserComposer;
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
