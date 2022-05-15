<?php declare(strict_types = 1);

namespace App\Repositories;

use App\Contracts\Repositories\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    public function get()
    {
        return collect();
    }

    public function create(array $input)
    {
        // TODO: Implement create() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function update($id, array $input)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
