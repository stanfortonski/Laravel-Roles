<?php

namespace Stanfortonski\Laravelroles\Helpers;

use Illuminate\Support\Facades\Blade;

class RoleDirectives
{
    static public function register()
    {
        Blade::if('role', function($role){
            if (auth()->check())
                return auth()->user()->hasRole($role);
            return false;
        });

        Blade::if('notrole', function($role){
            if (auth()->check())
                return !auth()->user()->hasRole($role);
            return false;
        });

        Blade::if('allofroles', function($roles){
            if (auth()->check())
                return auth()->user()->hasAllOfRoles($roles);
            return false;
        });

        Blade::if('roles', function($role){
            if (auth()->check()){
                return auth()->user()->hasOneOfRoles($role);
            }
            return false;
        });
    }
}
