<?php

namespace App\Models\Services;

use App\Contracts\AuthorizeInterface;
use App\Models\Traits\CheckRolesPermissions;
use App\Models\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Client
 * @package App\Models
 */
class Client extends Model implements AuthorizeInterface
{
    use HasFactory, HasApiTokens, Authorizable, HasRoles, CheckRolesPermissions, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
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
        //
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function (Client $client) {
            $client->fill([
                'uuid' => Str::uuid(),
            ]);
        });
    }

    public function test()
    {
        $this->tokens();
    }

    /**
     * Get the user's name.
     * @return string
     */
    public function getName() : string
    {
        return $this->name ?? 'unknown_name';
    }

    /**
     * Get the user's name.
     * @return string
     */
    public function getNameNoGaps() : string
    {
        if (empty($this->name)) {
            return 'unknown_name';
        }
        $name = trim($this->name);
        $name = str_replace('"', "", $name);
        $name = preg_replace("/\/\/.*?\n/", "\n", $name);
        return preg_replace("/\s+/", "_", $name);
    }

    /**
     * Get the user's uuid.
     * @return string
     */
    public function getId() : string
    {
        return $this->uuid ?? 'unknown_uuid';
    }
}
