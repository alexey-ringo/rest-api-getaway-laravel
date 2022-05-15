<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'permissions' => 'required|int_or_array'
        ];
    }
}
