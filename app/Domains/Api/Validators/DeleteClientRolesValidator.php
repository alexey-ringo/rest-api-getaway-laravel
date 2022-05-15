<?php

namespace App\Domains\Api\Validators;

use App\Contracts\Validation\ValidatorCreator;
use App\Domains\Api\Validators\Rules\ClientRolesRule;
use App\Models\Services\Client;
use App\Parents\Validators\Rules\ExistsRule;
use Illuminate\Support\Facades\Validator;

class DeleteClientRolesValidator implements ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'uuid' => ['required', 'string', 'max:100', new ExistsRule(Client::class, 'uuid')],
                'roles' => ['required', 'array', new ClientRolesRule($data, false)]
            ],
            [
            ]
        );
    }
}
