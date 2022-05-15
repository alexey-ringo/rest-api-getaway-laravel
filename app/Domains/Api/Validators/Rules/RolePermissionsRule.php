<?php

namespace App\Domains\Api\Validators\Rules;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class RolePermissionsRule implements Rule
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
            $this->messages->push('Не передан ни один id разрешений операций!');
            return $this->passes;
        }
        if (!is_array($value)) {
            $this->passes = false;
            $this->messages->push('id разрешений операций должны быть переданны в массиве!');
            return $this->passes;
        }
        $role = Role::find($this->data['id']);
        if (!isset($role)) {
            $this->passes = false;
            $this->messages->push('Не найдена роль для добавления разрешений операций');
            return $this->passes;
        }
        $existsPermissionIds = Permission::get()->map(static function (Permission $permission) {
            return $permission->id;
        })->toArray();
        $absentIds = array_diff($value, $existsPermissionIds);
        if (!empty($absentIds)) {
            $this->passes = false;
            $this->messages->push('Переданные id разрешений операций = ' . implode(",", $absentIds) .  ' отсутствует в общем списке разрешений!');
        }
        $existsRolePermissions = $role->permissions()->get();
        $existsRolePermissionIds = $existsRolePermissions->map(static function (Permission $permission) {
            return $permission->id;
        })->toArray();
        if ($this->typeOperation) {
            $duplicatePermissionIds = array_intersect($value, $existsRolePermissionIds);
            if (!empty($duplicatePermissionIds)) {
                $this->passes = false;
                $this->messages->push('У политики безопасности уже добавлены разрашения операций - ' . implode(",", $duplicatePermissionIds));
            }
        } else {
            $absentPermissionIds = array_diff($value, $existsRolePermissionIds);
            if (!empty($absentPermissionIds)) {
                $this->passes = false;
                $this->messages->push('Переданные для удаления разрашения операция - ' . implode(",", $absentPermissionIds) . ' отсутствуют у политики безопасности!');
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
