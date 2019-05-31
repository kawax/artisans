<?php

namespace App\Providers;

use App\Model\User;
use App\Model\Post;
use App\Observers\UserObserver;
use App\Observers\PostObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('production')) {
            User::observe(UserObserver::class);
            Post::observe(PostObserver::class);
        }

        Resource::withoutWrapping();

        Paginator::defaultView('vendor.pagination.bulma');
        Paginator::defaultSimpleView('vendor.pagination.simple-bulma');
    }
}
