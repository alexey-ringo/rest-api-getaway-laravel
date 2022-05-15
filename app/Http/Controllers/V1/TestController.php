<?php

namespace App\Http\Controllers\V1;

use App\Models\Services\Client;
use App\Models\ClientRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers\V1
 */
class TestController extends Controller
{
    /**
     * @param  Request  $request
     */
    public function __invoke(Request $request)
    {
        /** @var Role $role */
        $role = Role::find(1);

        /** @var User $user */
        $user = User::find(1);

        /** @var Client $user */
        $client = Client::find(1);

        ClientRole::where([
            'role_id'     => $role->id,
            'client_type' => User::class,
            'client_id'   => $user->id,
        ])->delete();

        $user->roles()->attach($role->id, ['client_type' => User::class]);
        // or: $user->addRole($role->id);

        $user->roles()->detach($role->id);
        // or: $user->deleteRole($role->id);

        ClientRole::where([
            'role_id'     => $role->id,
            'client_type' => Client::class,
            'client_id'   => $client->id,
        ])->delete();

        $client->roles()->attach($role->id, ['client_type' => Client::class]);
        // or: $client->addRole($role->id);

        $client->roles()->detach($role->id);
        // or: $client->deleteRole($role->id);

        dd(
            $role->toArray(),
            $role->clientRoles,
            $role->clients,
            $user->roles->toArray(),
            $client->roles->toArray(),
        );
    }
}
