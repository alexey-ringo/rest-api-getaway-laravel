<?php

namespace App\Domains\Api\Validators\Rules;

use App\Models\Role;
use App\Models\Services\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class StoreClientTokenRolesRule implements Rule
{
    private array $data;
    private Collection $messages;
    private bool $passes;

    public function __construct(array $data)
    {
        $this->data = $data;
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
        $client = Client::where('uuid', $this->data['uuid'])->first();
        if (!isset($client)) {
            $this->passes = false;
            $this->messages->push('Не найден клиент, которому нужно создать токен');
        }
        $existsRoleIds = Role::get()->map(static function (Role $role) {
            return $role->id;
        })->toArray();
        $absentIds = array_diff($value, $existsRoleIds);
        if (!empty($absentIds)) {
            $this->passes = false;
            $this->messages->push('Уснанавливаемые на создаваемом токене политики безопасности с id = ' . implode(",", $absentIds) . ' отсутствуют в общем списке политик!');
        }
        if (!$client->checkClientHasRoles($value)) {
            $this->passes = false;
            $this->messages->push('Политики безопасности, добавляемые в токен - отсутствует в наборе политик базового клиента!');
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
