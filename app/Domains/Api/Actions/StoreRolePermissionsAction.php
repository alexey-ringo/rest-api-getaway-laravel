<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\RolePermissionsDto;
use App\Domains\Api\Tasks\StoreRolePermissionsTask;
use App\Domains\Api\Validators\StoreRolePermissionsValidator;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

class StoreRolePermissionsAction
{
    /**
     * @var StoreRolePermissionsTask
     */
    private StoreRolePermissionsTask $updateRolePermissionsTask;

    /**
     * StoreRolePermissionsAction constructor.
     * @param StoreRolePermissionsTask $updateRolePermissionsTask
     */
    public function __construct(StoreRolePermissionsTask $updateRolePermissionsTask)
    {
        $this->updateRolePermissionsTask = $updateRolePermissionsTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(RolePermissionsDto $dto, int $id): Role
    {
        $data = $dto->toArrayNoGaps();
        $data['id'] = $id;
        $validator = StoreRolePermissionsValidator::create($data);
        if (!$validator->fails()) {
            return $this->updateRolePermissionsTask->run($dto, $id);
        }
        throw new ValidationException($validator);
    }
}
