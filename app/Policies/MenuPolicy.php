<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Menu $menu)
    {
        if ($user->is_supper_admin == 1) return true;

        if ($menu->parent_id == null) {
            $childMenus = $menu->getChildMenus()->where('name_route', 'like', '%' . '.index')->get();
            foreach ($childMenus as $childMenu) {
                $permissions = $user->hasPermissions($childMenu->name_route, 'indexAll');

                if ($user->status == '1' && $permissions != false && $permissions->indexAll != null && $permissions->indexAll == '1') {
                    return true;
                }
            }
            return $this->deny('Truy cập bị từ chối!');
        } else {
            $permissions = $user->hasPermissions($menu->name_route, 'indexAll');
        }

        if ($user->status == '1' && $permissions != false && $permissions->indexAll != null && $permissions->indexAll == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function view(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function update(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function delete(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function restore(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function forceDelete(User $user, Menu $menu)
    {
        //
    }
}
