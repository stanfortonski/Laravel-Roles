# Laravel-Roles
Users roles for Laravel applications.

# Information
This package provides you to set of middleware, migrations, directives and methods to user model which can you use for build Laravel Application wht different types of users. You can block or allow to use part of your application to for example admin or guest.

# Installation
1. First download package `composer require stanfortonski/laravel-roles`.
2. Setup provider. In config/app.php add folllowing code to bottom of providers:
```php
'providers' => [
    //...
    Stanfortonski\Laravelroles\ServiceProvider::class
],
```
3. Setup middleware. In app/Http/Kernel.php add folllowing code to bottom of middlewares:
```php
protected $routeMiddleware = [
    //...
    'role' => \Stanfortonski\Laravelroles\Middleware\Role::class,
    'roles' => \Stanfortonski\Laravelroles\Middleware\OneOfRoles::class,
    'allofroles' => \Stanfortonski\Laravelroles\Middleware\AllOfRoles::class
];
```
Additonal you can publish config file roles.php. Run command: `php artisan vendor:publish --provider="Stanfortonski\Laravelroles\ServiceProvider"`.

# Usage
If you want to determine which user can use the link. You need to use one of three middleware: roles, roles, allofroles.

Examples: (Attention you have to define admin, moderator and writer roles before! Go To Seeding example.)
1. Only admin can access to main page. 
```php
    Route::get('/', function () {
        return view('welcome');
    })->middleware('role:admin');
```
2. Only Admin or moderator can access to main page. 
```php
    Route::get('/', function () {
        return view('welcome');
    })->middleware('roles:admin|moderator');
```
3. Only User that have admin and writer roles (all of these) can access to main page. 
```php
    Route::get('/', function () {
        return view('welcome');
    })->middleware('allofroles:admin|writer');
```

## Seeding Example
If you want to define yours own roles run this command `php artisan make:seeder RoleSeeder` and next copy and paste below code to database/seeders/RoleSeeder.php.
```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    private $roles = [
        ['name' => 'admin', 'description' => 'User friendly text'], //role I
        //... next role
    ];

    public function run()
    {
        foreach ($this->roles as $role){
            DB::table('roles')->insert($role);
        }
    }
}
```
Then run `composer dump-autoload` and `php artisan migrate --seed`.
