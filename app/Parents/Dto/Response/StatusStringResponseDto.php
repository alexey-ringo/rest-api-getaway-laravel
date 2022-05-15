<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class StatusStringResponseDto
 * @package App\Parents\Dto\Response
 *
 * @OA\Schema(
 *     title="StatusStringResponseDto",
 *     description="StatusStringResponseDto",
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         example="Success",
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="Success message",
 *     ),
 * )
 *
 */

class StatusStringResponseDto extends DataTransferObject
{
    public string $status;
    public string $message;
}
