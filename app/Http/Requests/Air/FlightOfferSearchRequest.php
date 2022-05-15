<?php

namespace App\Http\Requests\Air;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FlightOfferSearchRequest
 * @package App\Http\Requests\Air
 *
 * @OA\Schema(
 *     title="FlightOfferSearchRequest",
 *     description="FlightOfferSearchRequest",
 *     type="object",
 *     required={"currencyCode"},
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         example="USD",
 *     ),
 * )
 *
 */
class FlightOfferSearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currencyCode' => [
                'required',
                'string',
            ],
        ];
    }
}
