<?php

namespace App\Parents\Validators\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class UniqueRule implements Rule
{
    private string $modelClassName;
    private int|null $entityId;
    private bool $trashed;
    private Collection $messages;
    private bool $passes;

    public function __construct(string $modelClassName, int $entityId = null, bool $trashed = false)
    {
        $this->modelClassName = $modelClassName;
        $this->entityId = $entityId;
        $this->trashed = $trashed;
        $this->messages = collect([]);
        $this->passes = true;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (isset($value)) {
            if (isset($this->entityId)) {
                if ($this->trashed) {
                    $attributeValueCollection = $this->modelClassName::withTrashed()->where($attribute, $value)->get();
                } else {
                    $attributeValueCollection = $this->modelClassName::where($attribute, $value)->get();
                }
                $attributeValueCollection = $this->modelClassName::withTrashed()->where($attribute, $value)->get();
                if (!($attributeValueCollection->count() === 1 && $attributeValueCollection[0]['id'] === $this->entityId)
                    && !($attributeValueCollection->count() === 0)) {
                    $this->passes = false;
                    $this->messages->push('Уже существует ' . $this->modelClassName . ' с таким же значением аттрибута ' . $attribute . ' !');
                }
            } else {
                if ($this->trashed) {
                    $uniqueEntity = $this->modelClassName::withTrashed()->where($attribute, $value)->first();
                } else {
                    $uniqueEntity = $this->modelClassName::where($attribute, $value)->first();
                }
                if (isset($uniqueEntity)) {
                    $this->passes = false;
                    $this->messages->push('Уже существует ' . $this->modelClassName . ' с таким же значением аттрибута ' . $attribute . ' !');
                }
            }
        }

        return $this->passes;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return $this->messages->toArray();
    }
}
