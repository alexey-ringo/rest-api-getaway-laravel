<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\DeleteRoleTask;

class DeleteRoleAction
{
    private DeleteRoleTask $deleteRoleTask;

    public function __construct(DeleteRoleTask $deleteRoleTask)
    {
        $this->deleteRoleTask = $deleteRoleTask;
    }

    public function run(int $id): bool
    {
        return $this->deleteRoleTask->run($id);
    }
}
