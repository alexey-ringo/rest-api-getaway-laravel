<?php

namespace App\Http\Controllers\V1\Api;

use App\Domains\Api\Actions\DeleteTokenAction;
use App\Exceptions\ApiLogicalException;
use App\Http\Controllers\V1\Controller;

class TokenController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DeleteTokenAction $action
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiLogicalException
     */
    public function destroy(int $id, DeleteTokenAction $action)
    {
        if (!$action->run($id)) {
            throw new ApiLogicalException('Ошибка удаления токена', 422);
        }
        return response()->json([
            'data' => [
                'message' => 'Токен удален'
            ]
        ]);
    }
}
