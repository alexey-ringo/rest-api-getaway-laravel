<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Support\Arr;

/**
 * Class ClientRolesDto
 * @package App\Domains\Api\Dto
 */
class ClientRolesDto extends DataTransferObject
{
    /**
     * @var array
     */
    public array $roles;

    /**
     * ClientRolesDto constructor.
     * @param array $data
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $data)
    {
        if (isset($data['roles']) && !is_array($data['roles'])) {
            $data['roles'] = Arr::wrap($data['roles']);
        }
        parent::__construct($data);
    }
}
