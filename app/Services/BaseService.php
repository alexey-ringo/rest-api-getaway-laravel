<?php declare(strict_types = 1);

namespace App\Services;

use App\Contracts\Repositories\RepositoryInterface;
use App\Contracts\Service\ServiceInterface;

/**
 * Class BaseService
 * @package App\Services
 */
abstract class BaseService implements ServiceInterface
{
    /** @var RepositoryInterface */
    protected $repository;

    /**
     * BaseService constructor.
     *
     * @param  RepositoryInterface  $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
