<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        \Log::debug(print_r($guards, true));
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard == 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($guard == 'talent') {
                    return redirect('/talent/dashboard');
                } elseif ($guard == 'company') {
                    return redirect('/company/dashboard');
                } else {
                    return redirect('/plan');
                }
            }
        }

        return $next($request);
    }
}
