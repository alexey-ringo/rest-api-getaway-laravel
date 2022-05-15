<?php

declare(strict_types = 1);

namespace App\Domains\Air\Dto\Response\AttributeDto;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class FlightOfferSearchAirResponseDictionariesDto
 * @package App\Domains\Air\Dto\Response\AttributeDto
 *
 * @OA\Schema(
 *     title="FlightOfferSearchAirResponseDictionariesDto",
 *     description="FlightOfferSearchAirResponseDictionariesDto",
 *     @OA\Property(
 *         property="locations",
 *         type="array",
 *         @OA\Items(),
 *     ),
 *     @OA\Property(
 *         property="aircraft",
 *         type="array",
 *         @OA\Items(),
 *     ),
 *     @OA\Property(
 *         property="currencies",
 *         type="array",
 *         @OA\Items(),
 *     ),
 *     @OA\Property(
 *         property="carriers",
 *         type="array",
 *         @OA\Items(),
 *     ),
 * )
 *
 */
class FlightOfferSearchAirResponseDictionariesDto extends DataTransferObject
{
    public array $locations;
    public array $aircraft;
    public array $currencies;
    public array $carriers;
}
