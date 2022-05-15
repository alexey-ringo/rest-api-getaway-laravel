<?php

namespace App\Domains\Api\Validators;

use App\Contracts\Validation\ValidatorCreator;
use App\Models\Services\Client;
use App\Parents\Validators\Rules\UniqueRule;
use Illuminate\Support\Facades\Validator;

class StoreClientValidator implements ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:100', new UniqueRule(Client::class)],
            ],
            [
            ]
        );
    }
}
