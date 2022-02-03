<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
     */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
     */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
     */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
     */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
     */

    'timezone' => 'Asia/Tokyo',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
     */

    'locale' => 'ja',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
     */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
     */

    'faker_locale' => 'ja_JP',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
     */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
     */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\FortifyServiceProvider::class,
        App\Providers\AdminLoginServiceProvider::class,
        \SocialiteProviders\Manager\ServiceProvider::class,
        App\Providers\SlackServiceProvider::class,
        App\Providers\DateFormatServiceProvider::class,
        App\Providers\EditMyProjectTabServiceProvider::class,
        App\Providers\ProgressBarStateServiceProvider::class,
        // 追加
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
     */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Http' => Illuminate\Support\Facades\Http::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        // 'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'DisplayVideoHelper' => App\Helpers\DisplayVideoHelper::class,
        'PrefectureHelper' => App\Helpers\PrefectureHelper::class,
        'ProjectReleaseStatus' => App\Enums\ProjectReleaseStatus::class,
        'PaymentJobCd' => App\Enums\PaymentJobCd::class,
        'GMOCvsCode' => App\Enums\GMOCvsCode::class,
        'Slack' => App\Services\Slack\SlackFacade::class,
        'DateFormat' => App\Services\Date\DateFormatFacade::class,
        'EditMyProjectTab' => App\Services\View\EditMyProjectTabFacade::class,
        'ProgressBarState' => App\Services\View\ProgressBarStateFacade::class,
    ],

    'axios_baseURL' => env('AXIOS_BASEURL'),
    'wp_baseURL' => env('WP_BASEURL'),
    'basic_auth' => env('BASIC_AUTH', false),
    'card_payment_api' => env('CARD_PAYMENT_API'),
    'pay_jp_secret' => env('PAY_JP_SECRET'),
    'pay_jp_key' => env('PAY_JP_KEY'),
    'pay_pay_key_for_test' => env('PAY_PAY_KEY_FOR_TEST'),
    'pay_pay_secret_for_test' => env('PAY_APY_SECRET_FOR_TEST'),
    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
    'gmo_entry_payment_url' => env('GMO_ENTRY_PAYMENT_URL'),
    'gmo_exec_payment_url' => env('GMO_EXEC_PAYMENT_URL'),
    'gmo_alter_payment_url' => env('GMO_ALTER_PAYMENT_URL'),
    'gmo_search_payment_url' => env('GMO_SEARCH_PAYMENT_URL'),
    'gmo_payment_detail_url' => env('GMO_PAYMENT_DETAIL_URL'),
    'gmo_bank_account_search_url' => env('GMO_BANK_ACCOUNT_SEARCH_URL'),
    'gmo_bank_account_url' => env('GMO_BANK_ACCOUNT_URL'),
    'gmo_remittance_deposit_url' => env('GMO_REMITTANCE_DEPOSIT_URL'),
    'gmo_search_remittance_url' => env('GMO_SEARCH_REMITTANCE_URL'),
    'gmo_mail_remittance_deposit_url' => env('GMO_MAIL_REMITTANCE_DEPOSIT_URL'),
    'gmo_mail_search_remittance_url' => env('GMO_MAIL_SEARCH_REMITTANCE_URL'),
    'gmo_shop_id' => env('GMO_SHOP_ID'),
    'gmo_shop_pass' => env('GMO_SHOP_PASS'),
    'gmo_pg_shop_id' => env('GMO_PG_SHOP_ID'),
    'gmo_pg_shop_pass' => env('GMO_PG_SHOP_PASS'),
    'gmo_cvs_entry_payment_url' => env('GMO_CVS_ENTRY_PAYMENT_URL'),
    'gmo_cvs_exec_payment_url' => env('GMO_CVS_EXEC_PAYMENT_URL'),
    'gmo_cvs_refund_payment_url' => env('GMO_CVS_REFUND_PAYMENT_URL'),
    'gmo_multi_search_payment_url' => env('GMO_MULTI_SEARCH_PAYMENT_URL'),
    'gmo_cvs_payment_detail_url' => env('GMO_CVS_PAYMENT_DETAIL_URL'),
    'merchant_id' => env('MERCHANT_ID'),
    'production_env' => env('PRODUCTION_ENV'),
    'sandbox' => env('SANDBOX'),
    'slack_url' => env('SLACK_URL'),
];
