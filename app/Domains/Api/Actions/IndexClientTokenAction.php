<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\IndexClientTokenTask;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexClientTokenAction
{
    /**
     * @var IndexClientTokenTask
     */
    private IndexClientTokenTask $indexTokenTask;

    /**
     * IndexClientTokenAction constructor.
     * @param IndexClientTokenTask $indexTokenTask
     */
    public function __construct(IndexClientTokenTask $indexTokenTask)
    {
        $this->indexTokenTask = $indexTokenTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(string $uuid): LengthAwarePaginator
    {
        return $this->indexTokenTask->run($uuid);
    }
}
