<?php

namespace App\Parents\Dto\Cast;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Caster;

class CollectionResponseCaster implements Caster
{
    protected string $responseDataDtoClassName;
    protected string|null $contentArrayName;
    protected string|null $subContentArrayName;
    protected array $data;

    /**
     * @param array $data
     * @param string $responseDataDtoClassName
     * @param string|null $contentArrayName
     * @param string|null $subContentArrayName
     */
    public function __construct(array $data, string $responseDataDtoClassName, ?string $contentArrayName = null, ?string $subContentArrayName = null)
    {
        $this->responseDataDtoClassName = $responseDataDtoClassName;
        $this->contentArrayName = $contentArrayName;
        $this->subContentArrayName = $subContentArrayName;

        $this->data = $data;
    }


    /**
     * @param array|mixed $value
     * @return Collection
     */
    public function cast(mixed $value): Collection
    {
        if (! isset($value) || ! is_array($value)) {
            return collect([]);
        }
        if (count($value) === 0) {
            return collect([]);
        }
        if (isset($this->contentArrayName)) {
            if (isset($this->subContentArrayName)) {
                $iterableResponseArray = $value[$this->contentArrayName][$this->subContentArrayName];
            } else {
                $iterableResponseArray = $value[$this->contentArrayName];
            }
        } else {
            $iterableResponseArray = $value;
        }
        return collect($iterableResponseArray)->map(function ($item) {
            return new $this->responseDataDtoClassName($item);
        });
    }
}
