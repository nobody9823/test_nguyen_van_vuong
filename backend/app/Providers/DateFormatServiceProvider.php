<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DateFormatServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'DateFormat',
            'App\Services\Date\DateFormatService'
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
