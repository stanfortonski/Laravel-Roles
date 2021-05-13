<?php

namespace Stanfortonski\Laravelroles\Traits;

use Stanfortonski\Laravelroles\Models\Role;
use Illuminate\Support\Facades\DB;

trait RolesRelation
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    public function clearRoles(): int
    {
        return DB::table('users_roles')->where('user_id', '=', $this->id)->delete();
    }
}
