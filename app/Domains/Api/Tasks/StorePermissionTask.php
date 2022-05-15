<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\StorePermissionDto;
use App\Models\Permission;

class StorePermissionTask
{
    public function run(StorePermissionDto $dto): Permission
    {
        /** @var Permission|null $permission */
        $permission = Permission::withTrashed()->where(['name' => $dto->name, 'slug' => $dto->slug])->first();
        if (isset($permission)) {
            $permission->restore();
        } else {
            /** @var Permission $permission */
            $permission = Permission::create($dto->toArray());
        }

        return $permission;
    }
}
