<?php

declare(strict_types = 1);

namespace App\Domains\Air\Tasks;

use App\Domains\Air\Dto\Response\ResponseDto\FlightOfferSearchAirResponseDto;
use App\Domains\Air\Tasks\Base\AbstractResourceAirTask;
use App\Parents\Tasks\AbstractTask;

class FlightOfferSearchAirTask extends AbstractResourceAirTask
{
    protected string $apiPath = '/shopping/flight-offers';
    protected string $httpType = AbstractTask::POST_TYPE;
    protected string $responseDtoClassName = FlightOfferSearchAirResponseDto::class;
}
