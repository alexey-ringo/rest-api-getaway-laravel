<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\DeleteClientRolesAction;
use App\Domains\Api\Actions\StoreClientRolesAction;
use App\Domains\Api\Dto\ClientRolesDto;
use App\Exceptions\ApiLogicalException;
use App\Http\Requests\Api\ClientRolesRequest;
use App\Http\Resources\Api\ClientResource;
use App\Http\Controllers\V1\Controller;

class ClientRolesController extends Controller
{
    /**
     * Store the specified resource in storage.
     *
     * @param ClientRolesRequest $request
     * @param string $uuid
     * @param StoreClientRolesAction $action
     *
     * @return ClientResource
     * @throws ApiLogicalException|\Illuminate\Validation\ValidationException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(ClientRolesRequest $request, string $uuid, StoreClientRolesAction $action)
    {
        $dto = new ClientRolesDto($request->validated());

        return new ClientResource($action->run($dto, $uuid));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClientRolesRequest $request
     * @param string $uuid
     * @param DeleteClientRolesAction $action
     *
     * @return ClientResource
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function destroy(ClientRolesRequest $request, string $uuid, DeleteClientRolesAction $action)
    {
        $dto = new ClientRolesDto($request->validated());

        return new ClientResource($action->run($dto, $uuid));
    }
}
