<?php

namespace App\Parents\Resources;

use App\Parents\Dto\Base\DataTransferObject;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

abstract class AbstractBaseResource extends JsonResource
{
    /**
     * Resolve the resource to an array.
     *
     * @param \Illuminate\Http\Request|null $request
     * @return array
     * @throws BindingResolutionException
     */
//    public function resolve($request = null)
//    {
//        $data = $this->toArray(
//            $request = $request ?: Container::getInstance()->make('request')
//        );
//dd($data);
//        if ($data instanceof DataTransferObject) {
//            $data = $data->toArrayNoGaps();
//        } elseif ($data instanceof Arrayable) {
//            $data = $data->toArray();
//        } elseif ($data instanceof JsonSerializable) {
//            $data = $data->jsonSerialize();
//        }
//
//        return $this->filter((array) $data);
//    }
}
