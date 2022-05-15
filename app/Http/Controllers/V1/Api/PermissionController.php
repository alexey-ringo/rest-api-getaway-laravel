<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\StorePermissionAction;
use App\Domains\Api\Actions\DeletePermissionAction;
use App\Domains\Api\Actions\IndexPermissionsAction;
use App\Domains\Api\Actions\ShowPermissionAction;
use App\Domains\Api\Actions\UpdatePermissionAction;
use App\Domains\Api\Dto\StorePermissionDto;
use App\Domains\Api\Dto\UpdatePermissionDto;
use App\Exceptions\ApiLogicalException;
use App\Http\Controllers\V1\Controller;
use App\Http\Requests\Api\StorePermissionRequest;
use App\Http\Requests\Api\UpdatePermissionRequest;
use App\Http\Resources\Api\PermissionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(IndexPermissionsAction $action)
    {
        return PermissionResource::collection($action->run());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @param StorePermissionAction $action
     *
     * @return PermissionResource
     * @throws \App\Exceptions\ApiLogicalException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StorePermissionRequest $request, StorePermissionAction $action)
    {
        $dto = new StorePermissionDto($request->validated());

        return new PermissionResource($action->run($dto));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  ShowPermissionAction  $action
     *
     * @return PermissionResource
     */
    public function show(int $id, ShowPermissionAction $action)
    {
        return new PermissionResource($action->run($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param int $id
     * @param UpdatePermissionAction $action
     *
     * @return PermissionResource
     * @throws \App\Exceptions\ApiLogicalException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function update(UpdatePermissionRequest $request, int $id, UpdatePermissionAction $action)
    {
        $dto = new UpdatePermissionDto($request->validated());

        return new PermissionResource($action->run($dto, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param \App\Domains\Api\Actions\DeletePermissionAction $action
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiLogicalException
     */
    public function destroy(int $id, DeletePermissionAction $action)
    {
        if (!$action->run($id)) {
            throw new ApiLogicalException('Ошибка удаления разрешения операции', 422);
        }
        return response()->json([
            'data' => [
                'message' => 'Разрешение операции удалено'
            ]
        ]);
    }
}
