<?php

namespace App\Parents\Validators\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class ExistsRule implements Rule
{
    private string $modelClassName;
    private string $columnName;
    private Collection $messages;
    private bool $passes;

    public function __construct(string $modelClassName, string $columnName = 'id')
    {
        $this->modelClassName = $modelClassName;
        $this->columnName = $columnName;
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
            if (is_array($value)) {
                $existsModelIds = $this->modelClassName::get()->map(static function ($model) {
                    return $model->id;
                })->toArray();
                $absentIds = array_diff($value, $existsModelIds);
                if (!empty($absentIds)) {
                    $this->passes = false;
                    $this->messages->push('Сущности ' . $this->modelClassName . ' с аттрибутом ' . $this->columnName . ' = ' . implode(",", $absentIds) . ' не найдены!');
                }
            } else {
                $client = $this->modelClassName::where($this->columnName, $value)->first();
                if (!isset($client)) {
                    $this->passes = false;
                    $this->messages->push('Сущность ' . $this->modelClassName . ' с аттрибутом ' . $this->columnName . ' = ' . $value . ' не найдена!');
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
