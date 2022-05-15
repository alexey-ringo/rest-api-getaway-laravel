<?php

namespace App\Models\Traits;

use App\Models\ClientRole;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait HasRoles
 * @package App\Models\Traits
 */
trait HasRoles
{
    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            (new ClientRole)->getTable(),
            'client_id',
        )->wherePivot('client_type', static::class);
    }

    /**
     * @param  int|int[]  $role_id
     *
     * @return void
     */
    public function addRole($role_id)
    {
        $this->roles()->attach($role_id, ['client_type' => static::class]);
    }

    /**
     * @param  int|int[]|null $role_id
     *
     * @return int
     */
    public function deleteRole($role_id = null)
    {
        return $this->roles()->detach($role_id);
    }
}
