<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->is_supper_admin == 1) return true;
        $permissions = $user->hasPermissions('roles.index', 'access');

        if ($user->status == '1' && $permissions != false && $permissions->access != null && $permissions->access == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('roles.index', 'index');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('roles.index', 'index');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('roles.index', 'index');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('roles.index', 'index');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('roles.index', 'index');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('roles.index', 'index');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }
}
