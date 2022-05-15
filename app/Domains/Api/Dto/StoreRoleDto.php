<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;

class StoreRoleDto extends DataTransferObject
{
    public string $name;
    public string $slug;
}
