<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\StoreRoleDto;
use App\Models\Role;

class StoreRoleTask
{
    public function run(StoreRoleDto $dto): Role
    {
        /** @var Role|null $role */
        $role = Role::withTrashed()->where(['name' => $dto->name, 'slug' => $dto->slug])->first();
        if (isset($role)) {
            $role->restore();
        } else {
            /** @var Role $role */
            $role = Role::create($dto->toArray());
        }

        return $role;
    }
}
