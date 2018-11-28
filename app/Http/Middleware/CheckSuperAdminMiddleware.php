<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckSuperAdminMiddleware
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
        // super admin check
        if (Auth::check() && Auth::user()->role != 'superadmin') {
            return redirect('/');
        }
        return $next($request);
    }
}
