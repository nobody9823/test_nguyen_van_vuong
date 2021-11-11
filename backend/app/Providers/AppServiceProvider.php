<?php

namespace App\Providers;

use App\Actions\PayPay\PayPay;
use App\Actions\CardPayment\PayJp;
use App\Actions\PayPay\PayPayInterface;
use App\Actions\CardPayment\CardPaymentInterface;
use App\Actions\CardPayment\GMO;
use App\Actions\CardPayment\Stripe;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

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

        $this->app->bind(CardPaymentInterface::class, GMO::class);

        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('components.common.pagination');
        // FIXME: スマホの時に以下のsimpleViewを表示されるようにするなど対応が必要
        // Paginator::defaultSimpleView('');
        /**
         * Collectionに対して paginate できるようにするマクロ
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
