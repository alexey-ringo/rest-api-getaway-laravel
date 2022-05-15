<?php

namespace App\Domains\Api\Tasks;

use App\Models\Role;

class ShowRoleTask
{
    public function run(int $id): Role
    {
        return Role::findOrFail($id)->load('permissions');
    }
}
