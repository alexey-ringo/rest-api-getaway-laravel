<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreClientRequest
 * @package App\Http\Requests\Api
 *
 *
 */
class StoreClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:100'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
