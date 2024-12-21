<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CheckDatabaseProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\CheckDatabaseConfig::class);
    }


    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
