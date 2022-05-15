<?php

namespace App\Domains\Api\Tasks;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexRoleTask
{
    public function run(): LengthAwarePaginator
    {
        $limit = request()->input('limit', 15);
        return Role::with('permissions:id,name,slug')->paginate($limit);
    }
}
