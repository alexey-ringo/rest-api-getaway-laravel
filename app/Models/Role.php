<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Role
 * @package App\Models
 *
 *
 */
class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * @return HasMany
     */
    public function clientRoles()
    {
        return $this->hasMany(ClientRole::class, 'role_id', 'id')
                    ->with('client');
    }

    /**
     * @return Collection
     */
    public function getClientsAttribute()
    {
        return $this->clientRoles->map(
            fn($client_role) => $client_role->client
        );
    }
}
