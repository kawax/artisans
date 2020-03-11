<?php

namespace App\Providers;

use App\Model\Post;
use App\Model\User;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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

        JsonResource::withoutWrapping();

        Paginator::defaultView('vendor.pagination.bulma');
        Paginator::defaultSimpleView('vendor.pagination.simple-bulma');
    }
}
