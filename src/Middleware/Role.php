<?php

namespace Stanfortonski\Laravelroles\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()){
            if (auth()->user()->hasRole($role)){
                return $next($request);
            }
        }
        abort(403);
    }
}
