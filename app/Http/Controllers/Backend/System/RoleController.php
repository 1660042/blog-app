<?php

namespace App\Http\Controllers\Backend\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Menu\MenuRepositoryInterface;

class RoleController extends Controller
{
    public function __construct(RoleRepositoryInterface $role, MenuRepositoryInterface $menu)
    {
        $this->role = $role;
        $this->menu = $menu;
    }
    public function index()
    {
        $roles = $this->role->getAll();

        return view('backend.role.index', compact('roles'));
    }

    public function create()
    {
        $menus = $this->menu->getMenusWithParam(2, 1);
        $data = compact('menus');
        return view('backend.role.create', $data);
    }

    public function store(Request $request) {
        dd($request->all());
    }
}
