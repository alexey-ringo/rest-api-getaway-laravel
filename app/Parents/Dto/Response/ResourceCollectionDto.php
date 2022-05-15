<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Support\Collection;

/**
 * Class ResourceCollectionDto
 * @package App\Parents\Dto\Response
 */
class ResourceCollectionDto extends DataTransferObject
{
    /**
     * @var int
     */
    public int $statusCode;
    /**
     * @var Collection
     */
    public Collection $collectionDto;

    public int $count = 0;
    public int $total = 0;
}
