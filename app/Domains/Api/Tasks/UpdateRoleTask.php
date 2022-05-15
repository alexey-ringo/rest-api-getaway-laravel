<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\UpdateRoleDto;
use App\Models\Role;

class UpdateRoleTask
{
    public function run(UpdateRoleDto $dto, int $id): Role
    {
        $role = Role::findOrFail($id);
        $role->update($dto->toArrayNoGaps());
        $role->fresh();

        return $role->load('permissions:id,name,slug');
    }
}
