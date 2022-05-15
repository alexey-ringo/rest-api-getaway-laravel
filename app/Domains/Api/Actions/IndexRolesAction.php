<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\IndexRoleTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexRolesAction
{
    private IndexRoleTask $indexRoleTask;

    public function __construct(IndexRoleTask $indexRoleTask)
    {
        $this->indexRoleTask = $indexRoleTask;
    }

    public function run(): LengthAwarePaginator
    {
        return $this->indexRoleTask->run();
    }
}
