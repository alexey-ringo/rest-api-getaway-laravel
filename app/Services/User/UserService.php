<?php declare(strict_types = 1);

namespace App\Services\User;

use App\Services\BaseService;
use Illuminate\Support\Collection;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService extends BaseService
{
    public function get(): Collection
    {
        return $this->repository->get();
    }

    public function create(array $input)
    {
        return $this->repository->create($input);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function update($id, array $input)
    {
        return $this->repository->update($id, $input);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
