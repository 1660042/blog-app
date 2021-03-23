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

    public function getRoleActive($key, $value)
    {
        return $this->_model->where([
            [$key, '=', $value],
            ['status', '=', '1']
        ])->first();
    }
}
