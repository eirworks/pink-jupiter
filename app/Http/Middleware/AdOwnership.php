<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AdOwnership
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
        $ad = $request->route('service');

        if ($ad)
        {
            if ($ad->user_id != auth()->id())
            {
                return redirect()
                    ->route('partner.services.index')
                    ->with('error', "Anda tidak punya akses ke halaman ini!");
            }
        }

        return $next($request);
    }
}
