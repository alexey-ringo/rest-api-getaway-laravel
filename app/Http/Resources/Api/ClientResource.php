<?php

namespace App\Http\Resources\Api;

use App\Models\Services\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Client
 */
class ClientResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid'  => $this->uuid,
            'name'  => $this->name,
            'roles' => RoleResource::collection($this->roles),
        ];
    }
}
