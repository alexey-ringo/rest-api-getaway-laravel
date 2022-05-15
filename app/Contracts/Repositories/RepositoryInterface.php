<?php

namespace App\Contracts\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Contracts\Repositories
 */
interface RepositoryInterface
{
    public function get();

    public function create(array $input);

    public function find($id);

    public function update($id, array $input);

    public function destroy($id);
}
