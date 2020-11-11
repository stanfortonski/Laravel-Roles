<?php

namespace Stanfortonski\Laravelroles\Middleware;

use Closure;

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
        if (auth()->check()){
            if (auth()->user()->hasRole($role)){
                return $next($request);
            }
        }
        abort(403);
    }
}
