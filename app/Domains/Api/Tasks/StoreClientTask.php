<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\StoreClientDto;
use App\Models\Services\Client;

class StoreClientTask
{
    public function run(StoreClientDto $dto): Client
    {
        /** @var Client|null $client */
        $client = Client::withTrashed()->where('name', $dto->name)->first();
        if (isset($client)) {
            $client->restore();
        } else {
            /** @var Client $client */
            $client = Client::create((array) $dto);
        }

        return $client;
    }
}
