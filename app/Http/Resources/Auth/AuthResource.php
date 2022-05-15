<?php

namespace App\Http\Resources\Auth;

use App\Parents\Resources\AbstractNoWrapResource;

class AuthResource extends AbstractNoWrapResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'  => $this->status,
            $this->mergeWhen(! empty($this->data), ['data' => $this->data])
        ];
    }
}
