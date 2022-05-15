<?php

namespace App\Domains\Air\Dto\Request;

use App\Domains\Air\Dto\Base\BaseAirRequestDto;

class FlightOfferSearchAirRequestDto extends BaseAirRequestDto
{
    public string $currencyCode;
}
