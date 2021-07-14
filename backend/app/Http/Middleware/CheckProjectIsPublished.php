<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProjectIsPublished
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->route('project')->end_date < now())
        {
            abort(404);
        };
        return $next($request);
    }
}
