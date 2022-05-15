<?php

namespace App\Domains\Api\Dto;

use App\Parents\Dto\Base\DataTransferObject;

class StorePermissionDto extends DataTransferObject
{
    public string $name;
    public string $slug;

    public static function fromRequest(array $data)
    {
        return new self([
            'name' => $data['name'],
            'slug' => $data['slug']
        ]);
    }
}
