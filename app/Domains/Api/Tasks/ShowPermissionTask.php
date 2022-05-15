<?php

namespace App\Domains\Api\Tasks;

use App\Models\Permission;

class ShowPermissionTask
{
    public function run(int $id): Permission
    {
        return Permission::findOrFail($id);
    }
}
