<?php

namespace App\Policies;

use Auth;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Models\Post;
use App\Models\User;
use App\Models\Menu;
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
        $permissions = $user->hasPermissions('posts.index', 'indexAll');

        if (Auth::user()->status == '1' && $permissions->indexAll != null && $permissions->indexAll == '1') {
            return true;
        } else {
            $this->deny('Ko the truy cap');
            return false;
        }

        if (Auth::user()->status == '1' && $permissions->indexAll != null && $permissions->indexAll == '1') {
            return true;
        } else {
            $this->deny('Ko the truy cap');
            return false;
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
        //if (!$this->viewAny($user, $post)) return false;

        $permissions = $user->hasPermissions('posts.index', 'index');

        if (Auth::user()->status == '1' && $permissions != false && $permissions->index != null && $permissions->index == '1') {
            return true;
        } else {
            return $this->deny('Truy cập bị từ chối!');
            //false;
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
        $permissions = $user->hasPermissions('posts.index', 'create');

        if (Auth::user()->status == '1' && $permissions != false && $permissions->create != null && $permissions->create == '1') {
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
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        $permissions = $user->hasPermissions('posts.index', 'edit');

        if (Auth::user()->status == '1' && $permissions != false && $permissions->edit != null && $permissions->edit == '1') {
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
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, MenuRepositoryInterface $post)
    {
        $permissions = $user->hasPermissions('posts.index', 'delete');

        if (Auth::user()->status == '1' && $permissions != false && $permissions->delete != null && $permissions->delete == '1') {
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
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, MenuRepositoryInterface $post)
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
    public function forceDelete(User $user, MenuRepositoryInterface $post)
    {
        //
    }
}
