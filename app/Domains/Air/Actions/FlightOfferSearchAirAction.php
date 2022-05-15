<?php

namespace App\Domains\Air\Actions;

use App\Domains\Air\Dto\Request\FlightOfferSearchAirRequestDto;
use App\Domains\Air\Tasks\FlightOfferSearchAirTask;
use App\Parents\Dto\Response\ResourceResponseDto;

class FlightOfferSearchAirAction
{
    private FlightOfferSearchAirTask $flightOfferSearchAirTask;

    public function __construct(FlightOfferSearchAirTask $flightOfferSearchAirTask)
    {
        $this->flightOfferSearchAirTask = $flightOfferSearchAirTask;
    }

    public function run(FlightOfferSearchAirRequestDto $dto): ResourceResponseDto
    {
        return $this->flightOfferSearchAirTask->run($dto);
    }
}
