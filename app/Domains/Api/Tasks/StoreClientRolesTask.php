<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\ClientRolesDto;
use App\Models\Services\Client;

/**
 * Class StoreClientRolesTask
 * @package App\Domains\Api\Tasks
 */
class StoreClientRolesTask
{
    /**
     * @param ClientRolesDto $dto
     * @param string $uuid
     * @return Client
     */
    public function run(ClientRolesDto $dto, string $uuid): Client
    {
        /** @var Client $client */
        $client  = Client::where('uuid', $uuid)->firstOrFail();
        $client->addRole($dto->roles);

        return $client->load('roles:id,name,slug');
    }
}
