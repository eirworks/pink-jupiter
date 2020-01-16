<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class ClickSession
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
        if (!$request->session()->has('tsocks'))
        {
            $request->session()->put('tsocks', Str::random(32));
        }

        return $next($request);
    }
}
