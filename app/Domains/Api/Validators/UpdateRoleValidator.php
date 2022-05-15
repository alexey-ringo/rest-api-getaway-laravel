<?php

namespace App\Domains\Api\Validators;

use App\Contracts\Validation\ValidatorCreator;
use App\Models\Permission;
use App\Models\Role;
use App\Parents\Validators\Rules\ExistsRule;
use App\Parents\Validators\Rules\UniqueRule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UpdateRoleValidator implements ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'name' => ['string', 'max:100', new UniqueRule(Role::class, $data['id'], true)],
                'slug' => ['string', 'max:100', new UniqueRule(Role::class, $data['id'], true)]
            ],
            [
            ]
        );
    }
}
