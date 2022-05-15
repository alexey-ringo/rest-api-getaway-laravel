<?php

namespace App\Domains\Api\Tasks;

use App\Models\Services\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexClientTask
{
    public function run(): LengthAwarePaginator
    {
        $limit = request()->input('limit', 15);
        return Client::with('roles:id,name,slug')->paginate($limit);
    }
}
