<?php

namespace App\Domains\Api\Tasks;

use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexPermissionTask
{
    public function run(): LengthAwarePaginator
    {
        $limit = request()->input('limit', 15);
        return Permission::paginate($limit);
    }
}
