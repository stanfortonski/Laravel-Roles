# Laravel-Roles
Users roles for Laravel applications.

# Information
This package provides you to set of middleware, migrations, directives and methods to user model which can you use for build Laravel Application wht different types of users. You can block or allow to use part of your application to for example admin or guest.

# Installation
1. First download package `composer require stanfortonski/laravel-roles`.
2. Setup provider. In config/app.php add folllowing code to bottom of providers:
```php
'providers' => [
    ...
    Stanfortonski\Laravelroles\ServiceProvider::class
],
```
3. Setup middleware. In app/Http/Kernel.php add folllowing code to bottom of middlewares:
```php
protected $routeMiddleware = [
    ...
    'role' => \Stanfortonski\Laravelroles\Middleware\Role::class,
    'roles' => \Stanfortonski\Laravelroles\Middleware\OneOfRoles::class,
    'allofroles' => \Stanfortonski\Laravelroles\Middleware\AllOfRoles::class
];
```
Additonal you can publish config file roles.php. Run command: `php artisan vendor:publish --provider="Stanfortonski\Laravelroles\ServiceProvider"`.
