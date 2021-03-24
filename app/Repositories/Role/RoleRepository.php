<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Role::class;
    }

    public function getRolesActive()
    {
        return $this->_model->where([
            ['status', '=', '1']
        ])->get();
    }

    function findRoleActive($key, $value, $compare)
    {
        return $this->_model->where([
            [$key, $compare, $value],
            ['status', '=', '1']
        ])->first();
    }
}
