<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\DeleteClientTask;

class DeleteClientAction
{
    private DeleteClientTask $deleteClientTask;

    public function __construct(DeleteClientTask $deleteClientTask)
    {
        $this->deleteClientTask = $deleteClientTask;
    }

    public function run(string $uuid): bool
    {
        return $this->deleteClientTask->run($uuid);
    }
}
