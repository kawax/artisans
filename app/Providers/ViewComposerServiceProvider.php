<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposer\PostComposer;
use App\Http\ViewComposer\UserComposer;

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
