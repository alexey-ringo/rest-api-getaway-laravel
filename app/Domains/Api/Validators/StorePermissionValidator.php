<?php

namespace App\Domains\Api\Validators;

use App\Contracts\Validation\ValidatorCreator;
use App\Models\Permission;
use App\Parents\Validators\Rules\UniqueRule;
use Illuminate\Support\Facades\Validator;

class StorePermissionValidator implements ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:100', new UniqueRule(Permission::class)],
                'slug' => ['required', 'string', 'max:100', new UniqueRule(Permission::class)],
            ],
            [
            ]
        );
    }
}
