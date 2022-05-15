<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\RolePermissionsDto;
use App\Models\Role;

/**
 * Class DeleteRolePermissionsTask
 * @package App\Domains\Api\Tasks
 */
class DeleteRolePermissionsTask
{
    /**
     * @param int $id
     * @param RolePermissionsDto $dto
     * @return Role
     */
    public function run(RolePermissionsDto $dto, int $id): Role
    {
        /** @var Role $role */
        $role = Role::findOrFail($id);
        $role->permissions()->detach($dto->permissions);

        return $role->load('permissions:id,name,slug');
    }
}
