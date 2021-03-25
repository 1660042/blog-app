<?php

namespace App\Policies;

use Auth;
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
        $menu = new Menu();
        $menu = $menu->where([
            ['url_page', '=', 'posts.index'],
            ['status', '=', '1']
        ])->first();
        $roles = Auth::user()->getRoles->where('status', '=', '1');
        $indexAll = '0';
        foreach($roles as $role) {
            if($role->getPermissions->where('menu_id', '=', $menu->id)->where('indexAll', '=', 1)->first() != null) {
                $indexAll = $role->getPermissions->where('menu_id', '=', $menu->id)->where('indexAll', '=', '1')->first()->indexAll;
            }
        }

        //$a = 1;

        if(Auth::user()->status == '1' && $indexAll != null && $indexAll == '1') {
            return true;
        }
        else {
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
        $menu = new Menu();
        $menu = $menu->where([
            ['url_page', '=', 'posts.index'],
            ['status', '=', '1']
        ])->first();
        $roles = Auth::user()->getRoles->where('status', '=', '1');
        $indexAll = '0';
        foreach($roles as $role) {
            if($role->getPermissions->where('menu_id', '=', $menu->id)->where('indexAll', '=', 1)->first() != null) {
                $indexAll = $role->getPermissions->where('menu_id', '=', $menu->id)->where('indexAll', '=', '1')->first()->indexAll;
            }
        }

        //$a = 1;

        if(Auth::user()->status == '1' && $indexAll != null && $indexAll == '1') {
            return true;
        }
        else {
            $this->deny('Ko the truy cap');
            return false;
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
        //
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
        //
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
        //
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
