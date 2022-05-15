<?php declare(strict_types = 1);

namespace App\Facades;

use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * Class Users
 * @package App\Facades
 *
 * @method static User|null create(array $input)
 */
class Users extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user_service';
    }
}
