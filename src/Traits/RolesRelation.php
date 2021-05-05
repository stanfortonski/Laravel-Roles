<?php

namespace Stanfortonski\Laravelroles\Traits;

use Stanfortonski\Laravelroles\Models\Role;

trait RolesRelation
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }
}
