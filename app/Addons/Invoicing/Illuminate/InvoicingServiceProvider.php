<?php

namespace App\Addons\Invoicing\Illuminate;

use Illuminate\Support\ServiceProvider;

class InvoicingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Addons/Invoicing/Helpers/Invoicing.php';
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
