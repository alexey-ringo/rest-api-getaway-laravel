<?php

namespace App\Models\Traits;

use App\Models\Role;

trait CheckRolesPermissions
{
    //$require = true - обязательное совпадение всех permission в массиве $permission (если это array)
    //$require = false - достаточно совпадение хотя бы одного permission в array $permission
    public function checkTokenPermissions($permission, bool $require = false): bool
    {
        //Если $permission - это массив:
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $permName = $this->checkTokenPermissions($permName);
                if ($permName && !$require) {
                    return true;
                } else if (!$permName && $require) {
                    return false;
                }
            }
            //Если на каждой итерации цикла $this->checkTokenPermissions($permName) всегда вернет true
            //т.е. - ги одно из условий выше не будет выполнено
            //и входящее $require == true
            return $require;
        } else {
            //Если $permission - это строка
            $currentAccessToken = $this->currentAccessToken();
            if (isset($currentAccessToken->abilities)) {
                $tokenRoleIds = $currentAccessToken->abilities;
            } else {
                return false;
            }
            $tokenRoles = $this->roles()->whereIn('roles.id', $tokenRoleIds)->get();
            foreach ($tokenRoles as $role) {
                foreach ($role->permissions as $perm) {
                    if (strcmp($permission, $perm->slug) === 0) {
                        return true;
                    }
                }
            }
            return false;
        }
    }

    public function checkClientHasRoles(array $tokenRoleIds): bool
    {
        $clientRoles = $this->roles;
        $clientRoleIds = $clientRoles->map(static function (Role $role) {
            return $role->id;
        })->toArray();
        if (!array_diff($tokenRoleIds, $clientRoleIds)) {
            return true;
        }
        return false;
    }
}
