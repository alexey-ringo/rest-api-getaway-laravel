<?php

namespace App\Domains\Air\Dto\Response\AttributeDto;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class FlightOfferSearchAirResponseMetaDto
 * @package App\Domains\Air\Dto\Response\AttributeDto
 *
 * @OA\Schema(
 *     title="FlightOfferSearchAirResponseMetaDto",
 *     description="FlightOfferSearchAirResponseMetaDto",
 *     @OA\Property(
 *         property="count",
 *         type="integer",
 *         example="2",
 *     ),
 * )
 *
 */
class FlightOfferSearchAirResponseMetaDto extends DataTransferObject
{
    public int $count;
}
