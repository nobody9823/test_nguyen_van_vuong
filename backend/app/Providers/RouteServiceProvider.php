<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/fanding/profile';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    //protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('payment_without_globalscope', function ($id) {
            return \App\Models\Payment::withoutGlobalScopes()->findOrFail($id);
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            //user page
            Route::prefix('fanding')
                ->middleware('web')
                ->as('user.')
                ->group(base_path('routes/user.php'));

            //admin page
            Route::prefix('admin')
                ->middleware('web')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            //talent page
            // Route::prefix('talent')
            //     ->middleware('web')
            //     ->as('talent.')
            //     ->group(base_path('routes/talent.php'));

            //company page
            // Route::prefix('company')
            //     ->middleware('web')
            //     ->as('company.')
            //     ->group(base_path('routes/company.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
