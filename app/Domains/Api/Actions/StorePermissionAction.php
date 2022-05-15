<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\StorePermissionDto;
use App\Domains\Api\Tasks\StorePermissionTask;
use App\Domains\Api\Validators\StorePermissionValidator;
use App\Models\Permission;
use Illuminate\Validation\ValidationException;

/**
 * Class StorePermissionAction
 * @package App\Domains\Api\Actions
 */
class StorePermissionAction
{
    /**
     * @var StorePermissionTask
     */
    private StorePermissionTask $storePermissionTask;

    /**
     * StorePermissionAction constructor.
     * @param StorePermissionTask $storePermissionTask
     */
    public function __construct(StorePermissionTask $storePermissionTask)
    {
        $this->storePermissionTask = $storePermissionTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(StorePermissionDto $dto): Permission
    {
        $validator = StorePermissionValidator::create((array)$dto);
        if (!$validator->fails()) {
            return $this->storePermissionTask->run($dto);
        }
        throw new ValidationException($validator);
    }
}
