<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\RolePermissionsDto;
use App\Domains\Api\Tasks\DeleteRolePermissionsTask;
use App\Domains\Api\Validators\DeleteRolePermissionsValidator;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

/**
 * Class DeleteRolePermissionsAction
 * @package App\Domains\Api\Actions
 */
class DeleteRolePermissionsAction
{
    /**
     * @var DeleteRolePermissionsTask
     */
    private DeleteRolePermissionsTask $deleteRolePermissionsTask;

    /**
     * DeleteRolePermissionsAction constructor.
     * @param DeleteRolePermissionsTask $deleteRolePermissionsTask
     */
    public function __construct(DeleteRolePermissionsTask $deleteRolePermissionsTask)
    {
        $this->deleteRolePermissionsTask = $deleteRolePermissionsTask;
    }

    /**
     * @param int $id
     * @param RolePermissionsDto $dto
     * @return Role
     * @throws ValidationException
     */
    public function run(RolePermissionsDto $dto, int $id): Role
    {
        $data = $dto->toArrayNoGaps();
        $data['id'] = $id;
        $validator = DeleteRolePermissionsValidator::create($data);
        if (!$validator->fails()) {
            return $this->deleteRolePermissionsTask->run($dto, $id);
        }
        throw new ValidationException($validator);
    }
}
