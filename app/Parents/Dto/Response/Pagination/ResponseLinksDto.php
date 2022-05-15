<?php

namespace App\Parents\Dto\Response\Pagination;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class ResponseLinksDto
 * @package App\Parents\Dto\Response
 *
 * @OA\Schema(
 *     title="SearchOrganizationResponseLinksDto",
 *     description="Search Organization Response Links",
 *     @OA\Property(
 *         property="first",
 *         type="string",
 *         example="https://dev.nko.tochno.st/api/service/organizations/search?page=1",
 *     ),
 *     @OA\Property(
 *         property="last",
 *         type="string",
 *         example="https://dev.nko.tochno.st/api/service/organizations/search?page=42",
 *     ),
 *     @OA\Property(
 *         property="prev",
 *         type="string",
 *         example="null",
 *     ),
 *     @OA\Property(
 *         property="next",
 *         type="string",
 *         example="https://dev.nko.tochno.st/api/service/organizations/search?page=2",
 *     ),
 * )
 *
 */
class ResponseLinksDto extends DataTransferObject
{
    public string $first;
    public string $last;
    public string|null $prev;
    public string|null $next;
}
