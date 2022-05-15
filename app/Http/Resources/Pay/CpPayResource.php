<?php

namespace App\Http\Resources\Pay;

use Illuminate\Http\Resources\Json\JsonResource;

class CpPayResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'  => $this->status,
            $this->mergeWhen(! empty($this->data), [
                'message' => $this->message,
                'code' => $this->code,
                'paReq' => $this->PaReq
            ])
        ];
    }
}
