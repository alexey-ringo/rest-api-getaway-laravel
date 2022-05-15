<?php

namespace App\Domains\Api\Actions;

use App\Domains\Api\Dto\ClientTokenDto;
use App\Domains\Api\Tasks\StoreClientTokenTask;
use App\Domains\Api\Validators\StoreClientTokenValidator;
use Illuminate\Validation\ValidationException;

class StoreClientTokenAction
{
    /**
     * @var StoreClientTokenTask
     */
    private StoreClientTokenTask $storeTokenTask;

    /**
     * StoreClientTokenAction constructor.
     * @param StoreClientTokenTask $storeTokenTask
     */
    public function __construct(StoreClientTokenTask $storeTokenTask)
    {
        $this->storeTokenTask = $storeTokenTask;
    }

    /**
     * @throws ValidationException
     */
    public function run(ClientTokenDto $dto, string $uuid): string
    {
        $data = $dto->toArrayNoGaps();
        $data['uuid'] = $uuid;
        $validator = StoreClientTokenValidator::create($data);
        if (!$validator->fails()) {
            return $this->storeTokenTask->run($dto, $uuid);
        }
        throw new ValidationException($validator);
    }
}
