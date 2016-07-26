<?php

namespace App\Http\Middleware;

use Closure;
use General;
use Sentinel;

class SentinelHasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (! has_access($permission)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 403);
            }

            return response()->view('backend.unauthorized');
        }

        return $next($request);

    }
}
