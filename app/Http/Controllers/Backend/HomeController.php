<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

class HomeController extends Controller
{

    public function __construct(
        PostRepositoryInterface $post,
        CategoryRepositoryInterface $category,
        AccountRepositoryInterface $account,
        RoleRepositoryInterface $role
    ) {
        $this->post = $post;
        $this->category = $category;
        $this->account = $account;
        $this->role = $role;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts['active'] = $this->post->countActive();
        $posts['total'] = $this->post->total();

        $categories['active'] = $this->category->countActive();
        $categories['total'] = $this->category->total();

        $accounts['active'] = $this->account->countActive();
        $accounts['total'] = $this->account->total();

        $roles['active'] = $this->role->countActive();
        $roles['total'] = $this->role->total();
        $data = compact('posts', 'categories', 'accounts', 'roles');
        return view('backend.home', $data);
    }
}
