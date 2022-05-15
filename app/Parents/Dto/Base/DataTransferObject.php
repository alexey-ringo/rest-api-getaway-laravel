<?php

namespace App\Parents\Dto\Base;

use Spatie\DataTransferObject\DataTransferObject as SpatieDataTransferObject;

/**
 * Class DataTransferObject
 * @package App\Parents\Dto
 */
class DataTransferObject extends SpatieDataTransferObject
{
    /**
     * @return array
     */
    public function toArrayNoGaps(): array
    {
        $dataArray = parent::toArray();

        return array_filter(
            $dataArray,
            function ($value) {
                return ($value !== null);
            }
        );
    }

//    public function toArray(): array
//    {
//        $dataArray = parent::toArray();
//
//        return array_filter(
//            $dataArray,
//            function ($value) {
//                return ($value !== null);
//            }
//        );
//    }
//
//    public function toArrayAllFields(): array
//    {
//        return parent::toArray();
//    }
}
