<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\UpdatePermissionDto;
use App\Models\Permission;

class UpdatePermissionTask
{
    public function run(UpdatePermissionDto $dto, int $id): Permission
    {
        $data = array_filter(
            (array) $dto,
            function ($value) {
                return ($value !== null);
            }
        );

        $permission = Permission::findOrFail($id);
        $permission->update($data);
        $permission->fresh();

        return $permission;
    }
}
