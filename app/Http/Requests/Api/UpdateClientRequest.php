<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateClientRequest
 * @package App\Http\Requests\Api
 *
 *
 */
class UpdateClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|max:100',
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
