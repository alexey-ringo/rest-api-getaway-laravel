<?php

namespace App\Contracts\Service;

use Illuminate\Support\Collection;

/**
 * Interface ServiceInterface
 * @package App\Contracts\Service
 */
interface ServiceInterface
{
    public function get(): Collection;

    public function create(array $input);

    public function find($id);

    public function update($id, array $input);

    public function destroy($id);
}
