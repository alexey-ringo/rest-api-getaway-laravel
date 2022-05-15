<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Support\Arr;

/**
 * Class RolePermissionsDto
 * @package App\Domains\Api\Dto
 */
class RolePermissionsDto extends DataTransferObject
{
    /**
     * @var array
     */
    public array $permissions;

    /**
     * RolePermissionsDto constructor.
     * @param array $data
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $data)
    {
        if (isset($data['permissions']) && !is_array($data['permissions'])) {
            $data['permissions'] = Arr::wrap($data['permissions']);
        }
        parent::__construct($data);
    }
}
