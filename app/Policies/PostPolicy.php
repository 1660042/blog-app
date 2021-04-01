<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Post $post)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('posts.index', 'access');

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
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('posts.index', 'index');

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
    public function create(User $user, Post $post)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('posts.index', 'create');


        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->create != null && $permissions->create == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('posts.index', 'edit');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->edit != null && $permissions->edit == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if ($user->is_supper_admin == 1) return true;

        $permissions = $user->hasPermissions('posts.index', 'delete');

        if ($user->status != '1' || $permissions == false || $permissions->access == null || $permissions->access != '1') {
            return $this->deny('Truy cập bị từ chối!');
        }

        if ($permissions->delete != null && $permissions->delete == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
