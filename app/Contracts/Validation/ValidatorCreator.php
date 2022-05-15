<?php

namespace App\Contracts\Validation;

interface ValidatorCreator
{
    public static function create(array $data): \Illuminate\Contracts\Validation\Validator;
}
