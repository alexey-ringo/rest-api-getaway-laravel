<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClientRolesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'roles' => 'required|int_or_array'
        ];
    }
}
