<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\DeleteRolePermissionsAction;
use App\Domains\Api\Actions\StoreRolePermissionsAction;
use App\Domains\Api\Dto\RolePermissionsDto;
use App\Http\Controllers\V1\Controller;
use App\Http\Requests\Api\RolePermissionsRequest;
use App\Http\Resources\Api\RoleResource;

class RolePermissionsController extends Controller
{
    /**
     * Store the specified resource in storage.
     *
     * @param RolePermissionsRequest $request
     * @param int $id
     * @param StoreRolePermissionsAction $action
     *
     * @return RoleResource
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(RolePermissionsRequest $request, int $id, StoreRolePermissionsAction $action)
    {
        $dto = new RolePermissionsDto($request->validated());

        return new RoleResource($action->run($dto, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RolePermissionsRequest $request
     * @param int $id
     * @param DeleteRolePermissionsAction $action
     *
     * @return RoleResource
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function destroy(RolePermissionsRequest $request, int $id, DeleteRolePermissionsAction $action)
    {
        $dto = new RolePermissionsDto($request->validated());

        return new RoleResource($action->run($dto, $id));
    }
}
