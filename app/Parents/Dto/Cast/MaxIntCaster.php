<?php

namespace App\Parents\Dto\Cast;

use Spatie\DataTransferObject\Caster;

class MaxIntCaster implements Caster
{
    /**
     * @param array|mixed $value
     * @return int
     */
    public function cast(mixed $value): int
    {
        if (! isset($value)) {
            return 30;
        }
        if (! (is_string($value) || is_int($value))) {
            return 30;
        }
        if (is_string($value)) {
            $value = (int) $value;
        }
        if ($value > 30) {
            $value = 30;
        }

        return $value;
    }
}
