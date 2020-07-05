<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AuthIsAdmin
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

        if (!(auth()->check() && auth()->user()->type == User::TYPE_ADMIN))
        {
            return redirect()->route('admin.login')
                ->with(['error' => __('auth.no_admin_authorization')]);
        }

        return $next($request);
    }
}
