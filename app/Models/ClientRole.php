<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ClientRole
 * @package App\Models
 */
class ClientRole extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'client_type',
        'client_id',
    ];

    /**
     * @return MorphTo
     */
    public function client()
    {
        return $this->morphTo('client');
    }
}
