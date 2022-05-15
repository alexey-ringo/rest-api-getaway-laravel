<?php

namespace App\Domains\Api\Validators;

use App\Contracts\Validation\ValidatorCreator;
use App\Domains\Api\Validators\Rules\RolePermissionsRule;
use App\Models\Role;
use App\Parents\Validators\Rules\ExistsRule;
use Illuminate\Support\Facades\Validator;

class DeleteRolePermissionsValidator implements ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'id' => ['required', 'integer', new ExistsRule(Role::class)],
                'permissions' => ['required', 'array', new RolePermissionsRule($data, false)]
            ],
            [
            ]
        );
    }
}
