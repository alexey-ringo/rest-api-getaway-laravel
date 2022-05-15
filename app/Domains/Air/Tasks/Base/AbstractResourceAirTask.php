<?php

declare(strict_types = 1);

namespace App\Domains\Air\Tasks\Base;

use App\Domains\Air\Dto\Base\BaseAirRequestDto;
use App\Exceptions\ApiLogicalException;
use App\Parents\Dto\Response\ResourceResponseDto;
use Illuminate\Validation\ValidationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class AbstractResourceAirTask extends AbstractAirTask
{
    /**
     * @throws UnknownProperties
     * @throws ApiLogicalException
     * @throws ValidationException
     */
    public function run(BaseAirRequestDto $dto): ResourceResponseDto
    {
        $this->sendHttp($dto);
        $this->responseValidationData();

        $this->fillResponseDto();

        return new ResourceResponseDto(responseDto: $this->responseResourceDto, statusCode: $this->response->status());
    }
}
