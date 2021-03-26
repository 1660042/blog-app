<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
        if($user->is_supper_admin == 1) return true;
        $permissions = $user->hasPermissions('categories.index', 'indexAll');

        if ($user->status == '1' && $permissions != false && $permissions->indexAll != null && $permissions->indexAll == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
            //false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function view(?User $user, Category $category)
    {
        // $permissions = $user->hasPermissions('categories.index', 'index');

        // if ($user->status == '1' && $permissions != false && $permissions->index != null && $permissions->index == '1') {
        //     return true;
        // } else {
        //     return $this->deny('Truy cập bị từ chối!');
        //     //false;
        // }
        return $this->deny('Truy cập bị từ chối!');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('categories.index', 'create');

        if ($user->status == '1' && $permissions != false && $permissions->create != null && $permissions->create == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
            //false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function update(?User $user, Category $category)
    {
        
        if($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('categories.index', 'edit');

        if ($user->status == '1' && $permissions != false && $permissions->edit != null && $permissions->edit == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
            //false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        if($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('categories.index', 'delete');

        if ($user->status == '1' && $permissions != false && $permissions->delete != null && $permissions->delete == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
            //false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
