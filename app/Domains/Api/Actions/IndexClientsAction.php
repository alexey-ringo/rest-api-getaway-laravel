<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\IndexClientTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexClientsAction
{
    private IndexClientTask $indexClientTask;

    public function __construct(IndexClientTask $indexClientTask)
    {
        $this->indexClientTask = $indexClientTask;
    }

    public function run(): LengthAwarePaginator
    {
        return $this->indexClientTask->run();
    }
}
