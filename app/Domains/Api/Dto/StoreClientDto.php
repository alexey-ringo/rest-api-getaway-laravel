<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;

class StoreClientDto extends DataTransferObject
{
    public string $name;

    public static function fromRequest(array $data)
    {
        return new self([
            'name' => $data['name']
        ]);
    }
}
