<?php

namespace App\Providers;

use App\Contracts\Repositories\RepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

/**
 * Class UsersServiceProvider
 * @package App\Providers
 */
class UsersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(UserService::class)
                  ->needs(RepositoryInterface::class)
                  ->give(UserRepository::class);

        $this->app->bind('user_service', function () {
            return resolve(UserService::class);
        });
    }
}
