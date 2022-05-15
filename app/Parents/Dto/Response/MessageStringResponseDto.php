<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class MessageStringResponseDto
 * @package App\Parents\Dto\Response
 *
 * @OA\Schema(
 *     title="MessageStringResponseDto",
 *     description="MessageStringResponseDto",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="Success message",
 *     ),
 * )
 *
 */

class MessageStringResponseDto extends DataTransferObject
{
    public string $message;
}
