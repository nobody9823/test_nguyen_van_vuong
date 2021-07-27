<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EditMyProjectTabServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'EditMyProjectTab',
            'App\Services\View\EditMyProjectTabService'
        );
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
