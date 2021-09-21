<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProgressBarStateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'ProgressBarState',
            'App\Services\View\ProgressBarStateService',
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
