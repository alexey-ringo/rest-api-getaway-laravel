<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class SimpleArrayDataResponseDto
 * @package App\Parents\Dto\Response
 *
 * @OA\Schema(
 *     title="StatusStringResponseDto",
 *     description="StatusStringResponseDto",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(),
 *     ),
 * )
 */
class SimpleArrayDataResponseDto extends DataTransferObject
{
    public array $data;
}
