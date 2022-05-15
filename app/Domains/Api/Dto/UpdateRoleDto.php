<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;

class UpdateRoleDto extends DataTransferObject
{
    public string|null $name;
    public string|null $slug;
}
