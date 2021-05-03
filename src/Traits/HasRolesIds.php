<?php

namespace Stanfortonski\Laravelroles\Traits;

use Illuminate\Support\Facades\DB;

trait HasRolesIds
{
    public function hasRoleById(int $id): bool
    {
        return $this->roles()->where('roles.id', $id)->count() > 0;
    }

    public function hasOneOfRolesByIds(array $ids): bool
    {
        foreach ($ids as $id){
            $relation = $this->roles();
            if (!empty($relation->where('roles.id', '=', $id)->first()))
                return true;
        }
        return false;
    }

    public function hasAllOfRolesByIds(array $ids): bool
    {
        foreach ($ids as $id){
            $relation = $this->roles();
            if (empty($relation->where('roles.id', '=', $id)->first()))
                return false;
        }
        return true;
    }

    public function removeRolesByIds(array $ids): int
    {
        return DB::table('users_roles')->where('user_id', '=', $this->id)->whereIn('role_id', $ids)->delete();
    }

    public function removeRoleById(int $id): int
    {
        return DB::table('users_roles')->where('user_id', '=', $this->id)->where('role_id', '=', $id)->delete();
    }
}
