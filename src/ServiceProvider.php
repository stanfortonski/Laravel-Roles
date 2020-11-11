<?php

namespace Stanfortonski\Laravelroles;

use Stanfortonski\Laravelroles\Helpers\RoleDirectives;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom($this->getConfigPath(), 'roles');

        if (config('roles.directives'))
            RoleDirectives::register();
    }

    public function boot()
    {
        $this->publishes([
            $this->getConfigPath() => config_path('roles.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function getConfigPath()
    {
        return __DIR__ . '/../config/roles.php';
    }
}
