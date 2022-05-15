<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\UpdateClientDto;
use App\Models\Services\Client;

class UpdateClientTask
{
    public function run(UpdateClientDto $dto, string $uuid): Client
    {
        $data = array_filter(
            (array) $dto,
            function ($value) {
                return ($value !== null);
            }
        );

        $client = Client::where('uuid', $uuid)->firstOrFail();
        $client->update($data);
        $client->fresh();

        return $client->load('roles:id,name,slug');
    }
}
