<?php

namespace App\Providers;

use App\Actions\PayPay\PayPay;
use App\Actions\CardPayment\PayJp;
use App\Actions\PayPay\PayPayInterface;
use App\Actions\CardPayment\CardPaymentInterface;
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

        $this->app->bind(CardPaymentInterface::class, PayJp::class);

        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 'extend' -> すでに依存解決済みのサービスを変更するメソッドで、こちらの場合は.envのcard_payment_apiによってサービスを変更しています。
        $this->app->extend(CardPaymentInterface::class, function ($service, $app) {
            if (config('app.card_payment_api') === 'stripe') {
                return new Stripe();
            } else if (config('app.card_payment_api') === 'payjp') {
                return new PayJp();
            }
        });

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
