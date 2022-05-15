<?php

namespace App\Domains\Api\Validators\Rules;

use App\Models\Role;
use App\Models\Services\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class ClientRolesRule implements Rule
{
    private array $data;
    private Collection $messages;
    //true - store, false - delete
    private bool $typeOperation;
    private bool $passes;

    public function __construct(array $data, bool $typeOperation = true)
    {
        $this->data = $data;
        $this->typeOperation = $typeOperation;
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
        if (empty($value)) {
            $this->passes = false;
            $this->messages->push('Не передан ни один id политик безопасности!');
            return $this->passes;
        }
        if (!is_array($value)) {
            $this->passes = false;
            $this->messages->push('id политик безопасности должны быть переданны в массиве!');
            return $this->passes;
        }
        $client = Client::where('uuid', $this->data['uuid'])->first();
        if (!isset($client)) {
            $this->passes = false;
            $this->messages->push('Не найден клиент для добавления политик безопасности');
            return $this->passes;
        }
        $existsRoleIds = Role::get()->map(static function (Role $role) {
            return $role->id;
        })->toArray();
        $absentIds = array_diff($value, $existsRoleIds);
        if (!empty($absentIds)) {
            $this->passes = false;
            $this->messages->push('Переданные id политик безопасности = ' . implode(",", $absentIds) .  ' отсутствует в общем списке политик!');
        }
        $existsClientRoles = $client->roles()->get();
        $existsClientRoleIds = $existsClientRoles->map(static function (Role $role) {
            return $role->id;
        })->toArray();
        if ($this->typeOperation) {
            $duplicateRoleIds = array_intersect($value, $existsClientRoleIds);
            if (!empty($duplicateRoleIds)) {
                $this->passes = false;
                $this->messages->push('У клиента уже добавлены политики безопасности - ' . implode(",", $duplicateRoleIds));
            }
        } else {
            $absentRoleIds = array_diff($value, $existsClientRoleIds);
            if (!empty($absentRoleIds)) {
                $this->passes = false;
                $this->messages->push('Переданные для удаления политики безопасности - ' . implode(",", $absentRoleIds) . ' отсутствуют у клиента!');
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
