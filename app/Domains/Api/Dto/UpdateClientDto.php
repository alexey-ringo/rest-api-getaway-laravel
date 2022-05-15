<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;

class UpdateClientDto extends DataTransferObject
{
    public string|null $name;

    public static function fromRequest(array $data)
    {
        return new self([
            'name' => $data['name'] ?? null
        ]);
    }
}
