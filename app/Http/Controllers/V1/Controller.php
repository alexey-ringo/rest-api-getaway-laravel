<?php

namespace App\Http\Controllers\V1;

use App\Contracts\AuthorizeInterface;
use App\Exceptions\ApiLogicalException;
use App\Exceptions\ApiPermissionDeniedException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="REST API GateWay",
 *    version="1.0.0",
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const AIR_FLIGHT_OFFER_SEARCH = 'air-flight_offer-search';

    /**
     * @param string|string[] $permission
     *
     * @return void
     * @throws ApiPermissionDeniedException
     */
    protected function authorizeToken($permission)
    {
        /** @var AuthorizeInterface $client */
        $client = auth()->user();
        if (! $client->checkTokenPermissions($permission)) {
            throw new ApiPermissionDeniedException('Permission denied to this API method');
        }
    }
}
