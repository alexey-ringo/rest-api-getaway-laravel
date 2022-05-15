<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class ResourceResponseDto
 * @package App\Parents\Dto\Response
 */
class ResourceResponseDto extends DataTransferObject
{
    /**
     * @var int
     */
    public int $statusCode;

    /**
     * @var DataTransferObject
     */
    public DataTransferObject $responseDto;
}
