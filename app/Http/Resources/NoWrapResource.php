<?php

namespace App\Http\Resources;

use App\Parents\Resources\AbstractNoWrapResource;

class NoWrapResource extends AbstractNoWrapResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
