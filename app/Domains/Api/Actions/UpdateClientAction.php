<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\UpdateClientDto;
use App\Domains\Api\Tasks\UpdateClientTask;
use App\Domains\Api\Validators\UpdateClientValidator;
use App\Models\Services\Client;
use Illuminate\Validation\ValidationException;

class UpdateClientAction
{
    /**
     * @var UpdateClientTask
     */
    private UpdateClientTask $updateClientTask;

    /**
     * UpdateClientAction constructor.
     * @param UpdateClientTask $updateClientTask
     */
    public function __construct(UpdateClientTask $updateClientTask)
    {
        $this->updateClientTask = $updateClientTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(UpdateClientDto $dto, string $uuid): Client
    {
        $data = array_filter(
            (array) $dto,
            function ($value) {
                return ($value !== null);
            }
        );
        $client = Client::where('uuid', $uuid)->firstOrFail();
        $data['id'] = $client->id;
        $validator = UpdateClientValidator::create($data);
        if (!$validator->fails()) {
            return $this->updateClientTask->run($dto, $uuid);
        }
        throw new ValidationException($validator);
    }
}
