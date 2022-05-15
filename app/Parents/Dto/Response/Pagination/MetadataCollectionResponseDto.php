<?php

namespace App\Parents\Dto\Response\Pagination;

use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Support\Collection;

/**
 * Class MetadataCollectionResponseDto
 * @package App\Parents\Dto\Response\Pagination
 */
class MetadataCollectionResponseDto extends DataTransferObject
{
    public Collection $data;
    public array $links;
    public array $meta;
}
