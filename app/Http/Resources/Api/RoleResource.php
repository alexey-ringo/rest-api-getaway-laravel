<?php

namespace App\Http\Resources\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin Role
 */
class RoleResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'permissions' => PermissionResource::collection($this->permissions),
        ];
    }
}
