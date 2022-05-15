<?php

namespace App\Domains\Api\Tasks;

use App\Models\Services\Client;

class ShowClientTask
{
    public function run(string $uuid): Client
    {
        $client = Client::where('uuid', $uuid)->firstOrFail();

        return $client->load('roles:id,name,slug');
    }
}
