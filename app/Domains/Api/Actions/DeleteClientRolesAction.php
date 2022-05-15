<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\ClientRolesDto;
use App\Domains\Api\Tasks\DeleteClientRolesTask;
use App\Domains\Api\Validators\DeleteClientRolesValidator;
use App\Models\Services\Client;
use Illuminate\Validation\ValidationException;

/**
 * Class DeleteClientRolesAction
 * @package App\Domains\Api\Actions
 */
class DeleteClientRolesAction
{
    /**
     * @var DeleteClientRolesTask
     */
    private DeleteClientRolesTask $deleteClientRolesTask;

    /**
     * DeleteClientRolesAction constructor.
     * @param DeleteClientRolesTask $deleteClientRolesTask
     */
    public function __construct(DeleteClientRolesTask $deleteClientRolesTask)
    {
        $this->deleteClientRolesTask = $deleteClientRolesTask;
    }

    /**
     * @param string $uuid
     * @param ClientRolesDto $dto
     * @return Client
     * @throws ValidationException
     */
    public function run(ClientRolesDto $dto, string $uuid): Client
    {
        $data = $dto->toArrayNoGaps();
        $data['uuid'] = $uuid;
        $validator = DeleteClientRolesValidator::create($data);
        if (!$validator->fails()) {
            return $this->deleteClientRolesTask->run($dto, $uuid);
        }
        throw new ValidationException($validator);
    }
}
