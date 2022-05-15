<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\StoreClientDto;
use App\Domains\Api\Tasks\StoreClientTask;
use App\Domains\Api\Validators\StoreClientValidator;
use App\Models\Services\Client;
use Illuminate\Validation\ValidationException;

class StoreClientAction
{
    /**
     * @var StoreClientTask
     */
    private StoreClientTask $storeClientTask;

    /**
     * StoreClientAction constructor.
     * @param StoreClientTask $storeClientTask
     */
    public function __construct(StoreClientTask $storeClientTask)
    {
        $this->storeClientTask = $storeClientTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(StoreClientDto $dto): Client
    {
        $validator = StoreClientValidator::create((array)$dto);
        if (!$validator->fails()) {
            return $this->storeClientTask->run($dto);
        }
        throw new ValidationException($validator);
    }
}
