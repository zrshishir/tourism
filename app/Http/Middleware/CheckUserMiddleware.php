<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserMiddleware
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
        // user check
        if (Auth::check() && Auth::user()->role != 'user') {
            return redirect('/');
        }
        return $next($request);
    }
}
