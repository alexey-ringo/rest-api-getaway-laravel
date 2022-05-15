<?php

declare(strict_types = 1);

namespace App\Http\Controllers\V1\Air;

use App\Domains\Air\Actions\FlightOfferSearchAirAction;
use App\Domains\Air\Dto\Request\FlightOfferSearchAirRequestDto;
use App\Exceptions\ApiPermissionDeniedException;
use App\Http\Controllers\V1\Controller;
use App\Http\Requests\Air\FlightOfferSearchRequest;
use App\Http\Resources\NoWrapResource;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class FlightOfferController extends Controller
{
    /**
     * The Flight Offers Search API searches over 500 airlines to find the cheapest flights for a given itinerary.
     *
     * @OA\Get(
     *     path="/air/flight-offers/search",
     *     operationId="flightOffersSearc",
     *     tags={"flight-offers-search"},
     *     summary="The API lets you can search flights between two cities, perform multi-city searches for longer itineraries and access one-way combinable fares to offer the cheapest options possible. For each itinerary, the API provides a list of flight offers with prices, fare details, airline names, baggage allowances and departure terminals.",
     *     description="The Flight Offers Search API searches over 500 airlines to find the cheapest flights for a given itinerary.",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FlightOfferSearchRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/FlightOfferSearchAirResponseDto")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="boolean",
     *                 example="false",
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(),
     *             ),
     *         ),
     *     ),
     * )
     *
     * @throws UnknownProperties
     * @throws ApiPermissionDeniedException
     */
    public function search(FlightOfferSearchRequest $request, FlightOfferSearchAirAction $action)
    {
        $this->authorizeToken(self::AIR_FLIGHT_OFFER_SEARCH);
        $dto = new FlightOfferSearchAirRequestDto($request->validated());
        $resourceResponseDto = $action->run($dto);

        return (new NoWrapResource($resourceResponseDto->responseDto->toArrayNoGaps()))->response()->setStatusCode($resourceResponseDto->statusCode);
    }
}
