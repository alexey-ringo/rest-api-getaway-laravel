<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\DeleteTokenTask;

class DeleteTokenAction
{
    /**
     * @var DeleteTokenTask
     */
    private DeleteTokenTask $deleteTokenTask;

    /**
     * DeleteTokenAction constructor.
     * @param DeleteTokenTask $deleteTokenTask
     */
    public function __construct(DeleteTokenTask $deleteTokenTask)
    {
        $this->deleteTokenTask = $deleteTokenTask;
    }

    public function run(int $id): bool
    {
        return $this->deleteTokenTask->run($id);
    }
}
