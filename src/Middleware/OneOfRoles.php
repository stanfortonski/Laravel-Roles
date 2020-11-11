<?php

namespace Stanfortonski\Laravelroles\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OneOfRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (Auth::check()){
            $rolesArr = explode('|', $roles);
            if (auth()->user()->hasOneOfRoles($rolesArr)){
                return $next($request);
            }
        }
        abort(403);
    }
}
