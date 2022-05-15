<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100',
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
