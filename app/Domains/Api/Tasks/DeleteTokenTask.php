<?php

namespace App\Domains\Api\Tasks;

use Laravel\Sanctum\PersonalAccessToken;

class DeleteTokenTask
{
    public function run(int $id): bool
    {
        $token = PersonalAccessToken::where('id', $id)->firstOrFail();

        return $token->delete();
    }
}
