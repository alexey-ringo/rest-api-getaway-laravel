<?php

declare(strict_types = 1);

namespace App\Domains\Air\Dto\Response\ResponseDto;

use App\Domains\Air\Dto\Response\AttributeDto\FlightOfferSearchAirResponseDictionariesDto;
use App\Domains\Air\Dto\Response\AttributeDto\FlightOfferSearchAirResponseMetaDto;
use App\Domains\Air\Dto\Response\DataDto\FlightOfferSearchAirResponseDataDto;
use App\Parents\Dto\Base\DataTransferObject;
use App\Parents\Dto\Cast\CollectionResponseCaster;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\CastWith;

;

/**
 * Class FlightOfferSearchAirResponseDto
 * @package App\Domains\Air\Dto\Response\ResponseDto
 *
 * @OA\Schema(
 *     title="FlightOfferSearchAirResponseDto",
 *     description="FlightOfferSearchAirResponseDto",
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         ref="#/components/schemas/FlightOfferSearchAirResponseMetaDto",
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/FlightOfferSearchAirResponseDataDto"),
 *     ),
 *     @OA\Property(
 *         property="dictionaries",
 *         type="object",
 *         ref="#/components/schemas/FlightOfferSearchAirResponseDictionariesDto",
 *     ),
 * )
 *
 */
class FlightOfferSearchAirResponseDto extends DataTransferObject{

    public FlightOfferSearchAirResponseMetaDto $meta;

    #[CastWith(CollectionResponseCaster::class, FlightOfferSearchAirResponseDataDto::class)]
    public Collection $data;

    public FlightOfferSearchAirResponseDictionariesDto $dictionaries;
}
