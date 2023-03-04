<?php

namespace App\Http\Middleware;

use Closure;

class police
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
        // do whatever you want to (check about) before proceeding to the next request.
        return $next($request);
    }
}
