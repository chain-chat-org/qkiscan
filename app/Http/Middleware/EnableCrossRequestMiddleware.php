<?php

namespace App\Http\Middleware;

use Closure;

class EnableCrossRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $response->header('Access-Control-Allow-Origin',$origin);
        $response->header('Access-Control-Allow-Headers', '*');
        $response->header('Cache-control','public');
        $response->header('Allow','GET,POST,OPTIONS');
        return $response;
    }
}
