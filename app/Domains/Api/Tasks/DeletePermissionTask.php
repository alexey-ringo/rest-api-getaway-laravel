<?php

namespace App\Domains\Api\Tasks;

use App\Models\Permission;

class DeletePermissionTask
{
    public function run(int $id): bool
    {
        $permission = Permission::findOrFail($id);
        $permission->roles()->detach();

        return $permission->delete();
    }
}
