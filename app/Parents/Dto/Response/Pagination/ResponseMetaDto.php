<?php

namespace App\Parents\Dto\Response\Pagination;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class ResponseMetaDto
 * @package App\Parents\Dto\Base\DataTransferObject
 *
 * @OA\Schema(
 *     title="ResponseMetaDto",
 *     description="Response Meta",
 *     @OA\Property(
 *         property="current_page",
 *         type="integer",
 *         example="3",
 *     ),
 *     @OA\Property(
 *         property="from",
 *         type="integer",
 *         example="21",
 *     ),
 *     @OA\Property(
 *         property="last_page",
 *         type="integer",
 *         example="42",
 *     ),
 *     @OA\Property(
 *         property="next",
 *         type="string",
 *         example="https://dev.nko.tochno.st/api/service/organizations/search?page=2",
 *     ),
 * )
 *
 */
class ResponseMetaDto extends DataTransferObject
{
    public int $current_page;
    public int $from;
    public int $last_page;
    public array $links;
    public string $path;
    public int $per_page;
    public int $to;
    public int $total;
}
