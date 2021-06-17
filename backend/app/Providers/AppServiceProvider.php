<?php

namespace App\Providers;

use App\Actions\PayPay\PayPay;
use App\Actions\PayJp\PayJp;
use App\Actions\PayPay\PayPayInterface;
use App\Actions\PayJp\PayJpInterface;
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
        $this->app->bind(PayPayInterface::class, PayPay::class);

        $this->app->bind(PayJpInterface::class, PayJp::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
