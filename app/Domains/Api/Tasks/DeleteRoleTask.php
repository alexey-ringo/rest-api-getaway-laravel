<?php

namespace App\Domains\Api\Tasks;

use App\Models\Role;

/**
 * Class DeleteRoleTask
 * @package App\Domains\Api\Tasks
 */
class DeleteRoleTask
{
    /**
     * @param int $id
     * @return bool
     */
    public function run(int $id): bool
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();

        return $role->delete();
    }
}
