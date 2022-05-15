<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\UpdateRoleDto;
use App\Domains\Api\Tasks\UpdateRoleTask;
use App\Domains\Api\Validators\UpdateRoleValidator;
use App\Exceptions\ApiLogicalException;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

class UpdateRoleAction
{
    /**
     * @var UpdateRoleTask
     */
    private UpdateRoleTask $updateRoleTask;

    /**
     * UpdateRoleAction constructor.
     * @param UpdateRoleTask $updateRoleTask
     */
    public function __construct(UpdateRoleTask $updateRoleTask)
    {
        $this->updateRoleTask = $updateRoleTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(UpdateRoleDto $dto, int $id): Role
    {
        $data = $dto->toArrayNoGaps();
        $client = Role::where('id', $id)->firstOrFail();
        $data['id'] = $client->id;
        $validator = UpdateRoleValidator::create($data);
        if (!$validator->fails()) {
            return $this->updateRoleTask->run($dto, $id);
        }
        throw new ValidationException($validator);
    }
}
