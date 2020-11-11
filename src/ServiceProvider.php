<?php

namespace Stanfortonski\Laravelroles;

use Stanfortonski\Laravelroles\Helpers\RoleDirectives;
use Stanfortonski\Laravelroles\Middleware\AllOfRoles;
use Stanfortonski\Laravelroles\Middleware\OneOfRoles;
use Stanfortonski\Laravelroles\Middleware\Role;
use Illuminate\Routing\Router;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        RoleDirectives::register();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function boot(Router $router)
    {
        $router->middleware('role', Role::class);
        $router->middleware('roles', OneOfRoles::class);
        $router->middleware('allofroles', AllOfRoles::class);
    }
}
