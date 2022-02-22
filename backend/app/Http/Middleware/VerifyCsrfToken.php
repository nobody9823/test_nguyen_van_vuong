<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        // リクエストが特定 URI から始まるものであれば
        if (\Str::startsWith($request->headers->get('referer'), config('app.wp_baseURL'))) {
            // いくつかの画面では CSRF チェックをしないようにする (配列への追加)
            $this->except = array_merge($this->except, ['/logout']);
        }
        return parent::handle($request, $next);
    }
}
