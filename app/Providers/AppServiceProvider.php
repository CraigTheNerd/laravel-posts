<?php

namespace App\Providers;


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
        //Paginator::useBootstrap();
//        Paginator::useTailwind();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  Paginator
        Paginator::useTailwind();
//        Paginator::useBootstrap();
//        Paginator::defaultView('view-name');
//        Paginator::useBootstrap();
    }
}
