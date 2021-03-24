<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{

    public function getRolesActive();

    function findRoleActive($key, $value, $compare);
}
