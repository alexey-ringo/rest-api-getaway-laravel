<?php

namespace App\Models;

use App\Contracts\AuthorizeInterface;
use App\Models\Traits\CheckRolesPermissions;
use App\Models\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 */
class User extends Model implements AuthorizeInterface
{
    use HasFactory, HasApiTokens, Authorizable, SoftDeletes, HasRoles, CheckRolesPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'external_id' => 'int',
    ];

    /**
     * Get the user's name.
     * @return string
     */
    public function getName() : string
    {
        return 'user';
    }

    /**
     * Get the user's name.
     * @return string
     */
    public function getNameNoGaps() : string
    {
        return 'user';
    }

    /**
     * Get the user's uuid.
     * @return string
     */
    public function getId() : string
    {
        return (string)$this->external_id ?? 'unknown_ext_id';
    }
}
