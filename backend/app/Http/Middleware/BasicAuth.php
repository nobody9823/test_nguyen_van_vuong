<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Config\Repository as Config;

class BasicAuth extends AuthenticateWithBasicAuth
{
    private $config;

    public function __construct(AuthFactory $auth, Config $config)
    {
        parent::__construct($auth);
        $this->config = $config;
    }

    public function handle($request, Closure $next, $guard = null, $field = null)
    {
        if ($this->config->get('app.basic_auth')) {
            return parent::handle($request, $next, $guard);
        }

        return $next($request);
    }
}
