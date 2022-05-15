<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\StoreRoleAction;
use App\Domains\Api\Actions\DeleteRoleAction;
use App\Domains\Api\Actions\IndexRolesAction;
use App\Domains\Api\Actions\ShowRoleAction;
use App\Domains\Api\Actions\UpdateRoleAction;
use App\Domains\Api\Dto\StoreRoleDto;
use App\Domains\Api\Dto\UpdateRoleDto;
use App\Exceptions\ApiLogicalException;
use App\Http\Controllers\V1\Controller;
use App\Http\Requests\Api\StoreRoleRequest;
use App\Http\Requests\Api\UpdateRoleRequest;
use App\Http\Resources\Api\RoleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(IndexRolesAction $action)
    {
        return RoleResource::collection($action->run());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @param StoreRoleAction $action
     *
     * @return RoleResource
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties|\Illuminate\Validation\ValidationException
     */
    public function store(StoreRoleRequest $request, StoreRoleAction $action)
    {
        $dto = new StoreRoleDto($request->validated());

        return new RoleResource($action->run($dto));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param int $id
     * @param ShowRoleAction $action
     * @return RoleResource
     */
    public function show(int $id, ShowRoleAction $action)
    {
        return new RoleResource($action->run($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param int $id
     * @param UpdateRoleAction $action
     *
     * @return RoleResource
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties|\Illuminate\Validation\ValidationException
     */
    public function update(UpdateRoleRequest $request, int $id, UpdateRoleAction $action)
    {
        $dto = new UpdateRoleDto($request->validated());

        return new RoleResource($action->run($dto, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DeleteRoleAction $action
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiLogicalException
     */
    public function destroy(int $id, DeleteRoleAction $action)
    {
        if (!$action->run($id)) {
            throw new ApiLogicalException('Ошибка удаления Политики безопасности', 422);
        }
        return response()->json([
            'data' => [
                'message' => 'Политика безопасности удалена'
            ]
        ]);
    }
}
