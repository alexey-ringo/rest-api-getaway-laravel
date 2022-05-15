<?php

namespace App\Contracts;

/**
 * Interface AuthorizeInterface
 * @package App\Contracts
 */
interface AuthorizeInterface
{
    /**
     * @param  string|string[]  $permission
     * @param  bool  $require
     *
     * @return bool
     */
    public function checkTokenPermissions($permission, bool $require = false): bool;

    public function getName() : string;
    public function getNameNoGaps() : string;
    public function getId() : string;
}
