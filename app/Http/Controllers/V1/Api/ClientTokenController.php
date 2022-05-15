<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\IndexClientTokenAction;
use App\Domains\Api\Actions\StoreClientTokenAction;
use App\Domains\Api\Dto\ClientTokenDto;
use App\Http\Requests\Api\ClientTokenRequest;
use App\Http\Controllers\V1\Controller;
use App\Http\Resources\Api\ClientTokenResource;
use Illuminate\Validation\ValidationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ClientTokenController extends Controller
{
    public function index(string $uuid, IndexClientTokenAction $action)
    {
        return ClientTokenResource::collection($action->run($uuid));
    }

    /**
     * Store a newly created resource in storage.
     * @throws UnknownProperties
     * @throws ValidationException
     */
    public function store(ClientTokenRequest $request, string $uuid, StoreClientTokenAction $action)
    {
        $dto   = new ClientTokenDto($request->validated());
        $token = $action->run($dto, $uuid);

        if ($token) {
            return response()->json([
                'data' => [
                    'token' => $token
                ]
            ]);
        }
    }
}
