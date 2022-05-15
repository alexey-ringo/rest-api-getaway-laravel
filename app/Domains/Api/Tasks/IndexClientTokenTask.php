<?php

namespace App\Domains\Api\Tasks;

use App\Models\Services\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Laravel\Sanctum\PersonalAccessToken;

class IndexClientTokenTask
{
    public function run(string $uuid): LengthAwarePaginator
    {
        /** @var Client $client */
        $client = Client::where('uuid', $uuid)->firstOrFail();
        $tokens = PersonalAccessToken::select(['id', 'tokenable_type', 'name', 'abilities', 'created_at', 'last_used_at'])
            ->where('tokenable_id', $client->id)->paginate(15);

        return $tokens;
    }
}
