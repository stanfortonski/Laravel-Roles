<?php

namespace Stanfortonski\Laravelroles\Traits;

trait HasRolesIdsAdapter
{
    use HasRolesIds {
        hasRoleById as hasRole;
        hasOneOfRolesByIds as hasOneOfRoles;
        hasAllOfRolesByIds as hasAllOfRoles;
        addRoleById as addRole;
        addRolesByIds as addRoles;
        removeRoleById as removeRole;
        removeRolesByIds as removeRoles;
    }
}
