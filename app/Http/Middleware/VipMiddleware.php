<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6) {
                return $next($request);
            }else{
                return redirect('/');
            }
        } else{
            return redirect('/login');
        }

        return $next($request);
    }
}



