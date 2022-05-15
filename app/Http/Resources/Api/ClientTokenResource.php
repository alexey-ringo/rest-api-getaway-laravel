<?php

namespace App\Http\Resources\Api;

use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientTokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token_id'  => $this->id,
            'client_type'  => $this->tokenable_type,
            'token_name'  => $this->name,
            'roles'  => Role::with('permissions:id,name,slug')->whereIn('id', $this->abilities)->get()->toArray(),
            'created_at'  => $this->created_at,
            'ast_used_at'  => $this->ast_used_at,
        ];
    }
}
