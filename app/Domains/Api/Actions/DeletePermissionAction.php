<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\DeletePermissionTask;

/**
 * Class DeletePermissionAction
 * @package App\Domains\Api\Actions
 */
class DeletePermissionAction
{
    /**
     * @var DeletePermissionTask
     */
    private DeletePermissionTask $deletePermissionTask;

    /**
     * DeletePermissionAction constructor.
     * @param DeletePermissionTask $deletePermissionTask
     */
    public function __construct(DeletePermissionTask $deletePermissionTask)
    {
        $this->deletePermissionTask = $deletePermissionTask;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function run(int $id): bool
    {
        return $this->deletePermissionTask->run($id);
    }
}
