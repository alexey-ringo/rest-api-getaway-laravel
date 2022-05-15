<?php

namespace App\Domains\Api\Validators;

use App\Contracts\Validation\ValidatorCreator;
use App\Domains\Api\Validators\Rules\StoreClientTokenRolesRule;
use App\Models\Services\Client;
use App\Parents\Validators\Rules\ExistsRule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class StoreClientTokenValidator implements ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'uuid' => ['required', 'string', 'max:100', new ExistsRule(Client::class, 'uuid')],
                'token_name' => 'required|string|max:100',
                'roles' => ['required', 'array', new StoreClientTokenRolesRule($data)]
            ],
            [
            ]
        );
    }
}
