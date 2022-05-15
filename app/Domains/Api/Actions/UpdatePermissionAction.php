<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\UpdatePermissionDto;
use App\Domains\Api\Tasks\UpdatePermissionTask;
use App\Domains\Api\Validators\UpdatePermissionValidator;
use App\Models\Permission;
use Illuminate\Validation\ValidationException;

class UpdatePermissionAction
{
    /**
     * @var UpdatePermissionTask
     */
    private UpdatePermissionTask $updatePermissionTask;

    /**
     * UpdatePermissionAction constructor.
     * @param UpdatePermissionTask $updatePermissionTask
     */
    public function __construct(UpdatePermissionTask $updatePermissionTask)
    {
        $this->updatePermissionTask = $updatePermissionTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(UpdatePermissionDto $dto, int $id): Permission
    {
        $data = array_filter(
            (array) $dto,
            function ($value) {
                return ($value !== null);
            }
        );
        $client = Permission::where('id', $id)->firstOrFail();
        $data['id'] = $client->id;
        $validator = UpdatePermissionValidator::create($data);
        if (!$validator->fails()) {
            return $this->updatePermissionTask->run($dto, $id);
        }
        throw new ValidationException($validator);
    }
}
