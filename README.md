# Laravel-Roles
Users roles for Laravel applications. Compatible with Laravel 7.x and 8.x.

# Information
This package provides you to set of middleware, migrations, directives and methods to user model which can you use for build Laravel Application wht different types of users. You can block or allow to use part of your application to for example admin or guest.

# Installation
1. First download package `composer require stanfortonski/laravel-roles`.
2. Setup provider. In config/app.php add following code to bottom of providers:
```php
'providers' => [
    //...
    Stanfortonski\Laravelroles\ServiceProvider::class
],
```
3. Setup middleware. In app/Http/Kernel.php add following code to bottom of middlewares:
```php
protected $routeMiddleware = [
    //...
    'role' => \Stanfortonski\Laravelroles\Middleware\Role::class,
    'roles' => \Stanfortonski\Laravelroles\Middleware\OneOfRoles::class,
    'allofroles' => \Stanfortonski\Laravelroles\Middleware\AllOfRoles::class
];
```
4. Use one of three traits HasRoles, HasRolesIds or HasRolesIdsAdapter in User class. Snippet: `use HasRoles;`, `use HasRolesIds;` or `use HasRolesIdsAdapter;`.
5. Additonal you can publish config file roles.php. Run command: `php artisan vendor:publish --provider="Stanfortonski\Laravelroles\ServiceProvider"`.

# Usage
## More about traits HasRoles, HasRolesIds or HasRolesIdsAdapter. 
- HasRoles is for roles based on names. Default way.
- HasRolesIds is for roles based on ids (methods suffix is ById or ByIds). HasRolesIds is actually for combining with HasRole.
- HasRolesIdsAdapter is for roles based on ids but methods are exactly same samed as in HasRoles trait. It is for independent use without HasRolesIds or HasRoles. Purpose of that is middlewares and directives doesn't work with HasRoleIds methods.

## Middleware
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

## Checking that user has roles
```php
    $result = $user->hasRole('admin');
```

```php
    $result = $user->hasOneOfRoles(['admin', 'mod']);
```

```php
    $result = $user->hasAllOfRoles(['admin', 'mod']);
```


## Adding roles
```php
    $user->addRole('admin');
```

```php
    $user->addRoles(['admin', 'writer']);
```

## Removing roles
```php
    $user->removeRole('admin');
```

```php
    $user->removeRoles(['admin', 'mod']);
```

- For HasRolesIds you have to use suffix ByIds for multiple or ById for singular. For parameter pass integer or array of integers.
- For HasRolesIdsAdapter you doesn't have to use suffix but for parameter you have to pass integer or array of integers.

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
