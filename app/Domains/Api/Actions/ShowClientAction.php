<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Tasks\ShowClientTask;
use App\Models\Services\Client;

class ShowClientAction
{
    /**
     * @var ShowClientTask
     */
    private ShowClientTask $showClientTask;

    /**
     * ShowClientAction constructor.
     * @param ShowClientTask $showClientTask
     */
    public function __construct(ShowClientTask $showClientTask)
    {
        $this->showClientTask = $showClientTask;
    }

    public function run(string $uuid): Client
    {
        return $this->showClientTask->run($uuid);
    }
}
