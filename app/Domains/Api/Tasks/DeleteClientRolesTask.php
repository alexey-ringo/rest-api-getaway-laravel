<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\ClientRolesDto;
use App\Models\Services\Client;

/**
 * Class DeleteClientRolesTask
 * @package App\Domains\Api\Tasks
 */
class DeleteClientRolesTask
{
    /**
     * @param string $uuid
     * @param ClientRolesDto $dto
     * @return Client
     */
    public function run(ClientRolesDto $dto, string $uuid): Client
    {
        /** @var Client $client */
        $client = Client::where('uuid', $uuid)->firstOrFail();
        $client->deleteRole($dto->roles);
        $client->fresh();

        return $client->load('roles:id,name,slug');
    }
}
