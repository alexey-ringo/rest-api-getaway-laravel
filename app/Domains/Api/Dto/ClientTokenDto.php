<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Support\Arr;

class ClientTokenDto extends DataTransferObject
{
    public string $token_name;
    public array $roles;

    /**
     * ClientTokenDto constructor.
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
