<?php

namespace Stanfortonski\Laravelroles\Traits;

use Illuminate\Support\Facades\DB;
use Stanfortonski\Laravelroles\Models\Role;

trait HasRoles
{
    use RolesRelation;

    public function hasRole(string $name): bool
    {
        return $this->roles()->where('roles.name', $name)->count() > 0;
    }

    public function hasAllOfRoles(array $names): bool
    {
        foreach ($names as $name){
            $relation = $this->roles();
            if (empty($relation->where('roles.name', '=', $name)->first()))
                return false;
        }
        return true;
    }

    public function hasOneOfRoles(array $names): bool
    {
        foreach ($names as $name){
            $relation = $this->roles();
            if (!empty($relation->where('roles.name', '=', $name)->first()))
                return true;
        }
        return false;
    }

    public function addRole(string $name): int
    {
        $role = Role::findOrFailByName($name);

        return DB::table('users_roles')->insert([
            'user_id' => $this->id,
            'role_id' => $role->id
        ]);
    }

    public function addRoles(array $names): void
    {
        foreach ($names as $name){
            $role = Role::findOrFailByName($name);

            DB::table('users_roles')->insert([
                'user_id' => $this->id,
                'role_id' => $role->id
            ]);
        }
    }

    public function removeRole(string $name): bool
    {
        $role = $this->roles()->where('roles.name', $name)->first();
        if (!empty($role))
            return DB::table('users_roles')->where('user_id', '=', $this->id)->where('role_id', '=', $role->id)->delete();
        return false;
    }

    public function removeRoles(array $names): void
    {
        foreach ($names as $name){
            $role = $this->roles()->where('roles.name', $name)->first();
            if (!empty($role))
                DB::table('users_roles')->where('user_id', '=', $this->id)->where('role_id', '=', $role->id)->delete();
        }
    }
}
