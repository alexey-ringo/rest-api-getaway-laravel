<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClientTokenRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token_name' => 'required|string|max:100',
            'roles' => 'int_or_array'
        ];
    }
}
