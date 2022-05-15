<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class StatusBoolResponseDto
 * @package App\Parents\Dto\Response
 *
 * @OA\Schema(
 *     title="StatusBoolResponseDto",
 *     description="StatusBoolResponseDto",
 *     @OA\Property(
 *         property="status",
 *         type="boolean",
 *         example="true",
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="Success message",
 *     ),
 * )
 */
class StatusBoolResponseDto extends DataTransferObject
{
    public bool $status;
    public string $message;
}
