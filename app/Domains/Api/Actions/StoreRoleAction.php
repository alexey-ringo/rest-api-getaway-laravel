<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\StoreRoleDto;
use App\Domains\Api\Tasks\StoreRoleTask;
use App\Domains\Api\Validators\StoreRoleValidator;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

class StoreRoleAction
{
    private StoreRoleTask $storeRoleTask;

    /**
     * StoreRoleAction constructor.
     * @param StoreRoleTask $storeRoleTask
     */
    public function __construct(StoreRoleTask $storeRoleTask)
    {
        $this->storeRoleTask = $storeRoleTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(StoreRoleDto $dto): Role
    {
        $data = $dto->toArrayNoGaps();
        $validator = StoreRoleValidator::create($data);
        if (!$validator->fails()) {
            return $this->storeRoleTask->run($dto);
        }
        throw new ValidationException($validator);
    }
}
