<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\ShowPermissionTask;
use App\Models\Permission;

class ShowPermissionAction
{
    private ShowPermissionTask $showPermissionTask;

    public function __construct(ShowPermissionTask $showPermissionTask)
    {
        $this->showPermissionTask = $showPermissionTask;
    }

    public function run(int $id): Permission
    {
        return $this->showPermissionTask->run($id);
    }
}
