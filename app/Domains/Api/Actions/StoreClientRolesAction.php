<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\ClientRolesDto;
use App\Domains\Api\Tasks\StoreClientRolesTask;
use App\Domains\Api\Validators\StoreClientRolesValidator;
use App\Models\Services\Client;
use Illuminate\Validation\ValidationException;

class StoreClientRolesAction
{
    /**
     * @var StoreClientRolesTask
     */
    private StoreClientRolesTask $updateClientRolesTask;

    /**
     * StoreClientRolesAction constructor.
     * @param StoreClientRolesTask $updateClientRolesTask
     */
    public function __construct(StoreClientRolesTask $updateClientRolesTask)
    {
        $this->updateClientRolesTask = $updateClientRolesTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(ClientRolesDto $dto, string $uuid): Client
    {
        $data = $dto->toArrayNoGaps();
        $data['uuid'] = $uuid;
        $validator = StoreClientRolesValidator::create($data);
        if (!$validator->fails()) {
            return $this->updateClientRolesTask->run($dto, $uuid);
        }
        throw new ValidationException($validator);
    }
}
