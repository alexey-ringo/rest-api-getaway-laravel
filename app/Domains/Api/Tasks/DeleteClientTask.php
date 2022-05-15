<?php

namespace App\Domains\Api\Tasks;

use App\Models\Services\Client;
use Exception;

/**
 * Class DeleteClientTask
 * @package App\Domains\Api\Tasks
 */
class DeleteClientTask
{
    /**
     * @throws Exception
     */
    public function run(string $uuid): bool
    {
        /** @var Client $client */
        $client = Client::where('uuid', $uuid)->firstOrFail();
        $client->deleteRole();

        return $client->delete();
    }
}
