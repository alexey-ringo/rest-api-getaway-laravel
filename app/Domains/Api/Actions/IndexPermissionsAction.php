<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\IndexPermissionTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexPermissionsAction
{
    private IndexPermissionTask $indexPermissionTask;

    public function __construct(IndexPermissionTask $indexPermissionTask)
    {
        $this->indexPermissionTask = $indexPermissionTask;
    }

    public function run(): LengthAwarePaginator
    {
        return $this->indexPermissionTask->run();
    }
}
