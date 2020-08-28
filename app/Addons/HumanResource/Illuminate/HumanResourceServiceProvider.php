<?php

namespace App\Addons\HumanResource\Illuminate;

use Illuminate\Support\ServiceProvider;

class HumanResourceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Addons/HumanResource/Helpers/HumanResource.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
