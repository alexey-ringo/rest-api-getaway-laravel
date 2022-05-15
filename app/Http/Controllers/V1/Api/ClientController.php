<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\StoreClientAction;
use App\Domains\Api\Actions\DeleteClientAction;
use App\Domains\Api\Actions\IndexClientsAction;
use App\Domains\Api\Actions\ShowClientAction;
use App\Domains\Api\Actions\UpdateClientAction;
use App\Domains\Api\Dto\StoreClientDto;
use App\Domains\Api\Dto\UpdateClientDto;
use App\Exceptions\ApiLogicalException;
use App\Http\Requests\Api\StoreClientRequest;
use App\Http\Requests\Api\UpdateClientRequest;
use App\Http\Resources\Api\ClientResource;
use App\Http\Controllers\V1\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return AnonymousResourceCollection
     */
    public function index(IndexClientsAction $action)
    {
        return ClientResource::collection($action->run());
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(StoreClientRequest $request, StoreClientAction $action)
    {
        $dto = new StoreClientDto($request->validated());

        return new ClientResource($action->run($dto));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  string  $uuid
     * @param  ShowClientAction  $action
     *
     * @return ClientResource
     */
    public function show(string $uuid, ShowClientAction $action)
    {
        return new ClientResource($action->run($uuid));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param UpdateClientRequest $request
     * @param string $uuid
     * @param UpdateClientAction $action
     *
     * @return ClientResource
     * @throws ApiLogicalException|\Illuminate\Validation\ValidationException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function update(UpdateClientRequest $request, string $uuid, UpdateClientAction $action)
    {
        $dto = new UpdateClientDto($request->validated());

        return new ClientResource($action->run($dto, $uuid));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @param DeleteClientAction $action
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiLogicalException
     */
    public function destroy(string $uuid, DeleteClientAction $action)
    {
        if (!$action->run($uuid)) {
            throw new ApiLogicalException('Ошибка удаления Клиента', 422);
        }
        return response()->json([
            'data' => [
                'message' => 'Клиент удален'
            ]
        ]);
    }
}
