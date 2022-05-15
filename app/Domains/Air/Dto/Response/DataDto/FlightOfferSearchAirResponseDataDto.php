<?php

namespace App\Domains\Air\Dto\Response\DataDto;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class FlightOfferSearchAirResponseDataDto
 * @package App\Parents\Dto\Base\DataTransferObject
 *
 * @OA\Schema(
 *     title="FlightOfferSearchAirResponseDataDto",
 *     description="FlightOfferSearchAirResponseDataDto",
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         example="flight-offer",
 *     ),
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         example="1",
 *     ),
 *     @OA\Property(
 *         property="source",
 *         type="string",
 *         example="605",
 *     ),
 *     @OA\Property(
 *         property="instantTicketingRequired",
 *         type="boolean",
 *         example="false",
 *     ),
 *     @OA\Property(
 *         property="nonHomogeneous",
 *         type="boolean",
 *         example="false",
 *     ),
 *     @OA\Property(
 *         property="oneWay",
 *         type="boolean",
 *         example="false",
 *     ),
 *     @OA\Property(
 *         property="2lastTicketingDate",
 *         type="string",
 *         example="2022-11-01",
 *     ),
 *     @OA\Property(
 *         property="numberOfBookableSeats",
 *         type="integer",
 *         example="9",
 *     ),
 *     @OA\Property(
 *         property="itineraries",
 *         type="array",
 *         @OA\Items(),
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="array",
 *         @OA\Items(),
 *     ),
 *     @OA\Property(
 *         property="pricingOptions",
 *         type="array",
 *         @OA\Items(),
 *     ),
 *     @OA\Property(
 *         property="travelerPricings",
 *         type="array",
 *         @OA\Items(),
 *     ),
 * )
 *
 */
class FlightOfferSearchAirResponseDataDto extends DataTransferObject
{
    public string $type;
    public string $id;
    public string $source;
    public bool $instantTicketingRequired;
    public bool $nonHomogeneous;
    public bool $oneWay;
    public string $lastTicketingDate;
    public int $numberOfBookableSeats;
    public array $itineraries;
    public array $price;
    public array $pricingOptions;
    public array $validatingAirlineCodes;
    public array $travelerPricings;
}
