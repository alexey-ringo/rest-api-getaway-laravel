<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;

class UpdatePermissionDto extends DataTransferObject
{
    public string|null $name;
    public string|null $slug;

    public static function fromRequest(array $data)
    {
        return new self([
            'name' => $data['name'] ?? null,
            'slug' => $data['slug'] ?? null
        ]);
    }
}
