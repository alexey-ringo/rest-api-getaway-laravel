<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\ShowRoleTask;
use App\Models\Role;

class ShowRoleAction
{
    private ShowRoleTask $showRoleTask;

    public function __construct(ShowRoleTask $showRoleTask)
    {
        $this->showRoleTask = $showRoleTask;
    }

    public function run(int $id): Role
    {
        return $this->showRoleTask->run($id);
    }
}
