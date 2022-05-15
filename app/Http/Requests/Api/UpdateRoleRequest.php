<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|max:100',
            'slug' => 'string|max:100'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
