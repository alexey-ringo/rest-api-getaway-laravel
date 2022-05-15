<?php

namespace App\Domains\Api\Tasks;

use App\Domains\Api\Dto\ClientTokenDto;
use App\Models\Services\Client;

class StoreClientTokenTask
{
    public function run(ClientTokenDto $dto, string $uuid): string
    {
        $client = Client::where('uuid', $uuid)->firstOrFail();

        return $client->createToken($dto->token_name, $dto->roles)->plainTextToken;
    }
}
