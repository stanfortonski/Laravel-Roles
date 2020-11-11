<?php

namespace Stanfortonski\Laravelroles\Traits;

use Illuminate\Support\Facades\DB;

trait HasRole
{
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
    }

    public function hasRole(string $name): bool
    {
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id')->where('roles.name', $name)->count() > 0;
    }

    public function hasAllOfRoles(array $names): bool
    {
        foreach ($names as $name){
            $relation = $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
            if (empty($relation->where('roles.name', '=', $name)->first()))
                return false;
        }
        return true;
    }

    public function hasOneOfRoles(array $names): bool
    {
        foreach ($names as $name){
            $relation = $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
            if (!empty($relation->where('roles.name', '=', $name)->first()))
                return true;
        }
        return false;
    }

    public function hasRoleById(int $id): bool
    {
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id')->where('roles.id', $id)->count() > 0;
    }

    public function hasOneOfRolesById(array $ids): bool
    {
        foreach ($ids as $id){
            $relation = $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
            if (!empty($relation->where('roles.id', '=', $id)->first()))
                return true;
        }
        return false;
    }

    public function hasAllOfRolesById(array $ids): bool
    {
        foreach ($ids as $id){
            $relation = $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
            if (empty($relation->where('roles.id', '=', $id)->first()))
                return false;
        }
        return true;
    }

    public function clearRoles(): int
    {
        return DB::table('users_roles')->where('user_id', '=', $this->id)->delete();
    }

    public function removeRolesById(array $ids): int
    {
        return DB::table('users_roles')->where('user_id', '=', $this->id)->whereIn('role_id', $ids)->delete();
    }

    public function removeRoleById(int $id): int
    {
        return DB::table('users_roles')->where('user_id', '=', $this->id)->where('role_id', '=', $id)->delete();
    }
}
