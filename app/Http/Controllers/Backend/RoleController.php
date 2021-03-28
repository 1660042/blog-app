<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use App\Models\Role;
use App\Http\Requests\Backend\Role\RoleRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Menu\MenuRepositoryInterface;

class RoleController extends Controller
{
    public function __construct(RoleRepositoryInterface $role, MenuRepositoryInterface $menu, Role $_role)
    {
        $this->role = $role;
        $this->menu = $menu;
        $this->_role = $_role;
    }
    public function index()
    {

        $this->authorize('view', $this->_role);

        $roles = $this->role->getAll();

        $status = config('status.status');

        return view('backend.role.index', compact('roles', 'status'));
    }

    public function create()
    {

        $this->authorize('create', $this->_role);
        $menus = $this->menu->getMenusWithParam(2, 1);
        $data = compact('menus');
        return view('backend.role.create', $data);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', $this->_role);

        $this->permissions = config('role.permission');

        $fillable = config('fillable.role');

        if (
            !$request->has($this->permissions['INDEX']) && !$request->has($this->permissions['SHOW'])
            && !$request->has($this->permissions['CREATE']) && !$request->has($this->permissions['EDIT'])
            && !$request->has($this->permissions['DELETE']) && !$request->has('CENSOR')
            && !$request->has($this->permissions['INDEXALL'])
        ) {

            $msg = $this->getMessage(false, '', 'Vui lòng tick chọn các quyền của ứng dụng trước khi lưu!');

            return redirect()->route('backend.systems.roles.create')->with($msg);
        }

        if ($request->has('status') == false)
            $request->merge(['status' => '0']);

        $request->merge(
            [
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]
        );

        $data = $this->getFilterData($request, $fillable);

        DB::beginTransaction();
        try {
            // unset($data['updated_by']);
            $result = $this->role->create($data);
            if (!$result) {
                DB::rollback();
                $msg = $this->getMessage($result, '', 'Thêm quyền thất bại!');
                return redirect()->route('backend.systems.roles.create')->with($msg);
            }

            $role = $this->role->find($result->id);

            //dd($request->index);
            if (!$this->insertPermissions($request, $role)) {

                $msg = $this->getMessage(false, '', 'Thêm quyền thất bại!');
                DB::rollback();
                return redirect()->route('backend.systems.roles.create')->with($msg);
            }

            $msg = $this->getMessage($result, 'Thêm quyền thành công!', '');

            DB::commit();
            return redirect()->route('backend.systems.roles.index')->with($msg);
        } catch (Exception $e) {

            DB::rollback();
            $msg = $this->getMessage(false, '', 'Đã có lỗi trong Exception!');
            return redirect()->route('backend.systems.roles.create')->with($msg);
        }
    }

    public function edit($id)
    {

        $this->authorize('update', $this->_role);

        $menus = $this->menu->getMenusWithParam(2, 1);
        $role = $this->role->find($id);

        // foreach ($role->getMenus as $a) {
        //     dd($a->pivot->where([['menu_id', '=', 5]])->get());
        // }

        //dd($role->getPermissions->where('menu_id', '=', '5')->first()->index);

        $data = compact('menus', 'role');
        return view('backend.role.edit', $data);
    }

    public function update(RoleRequest $request, $id)
    {
        $this->authorize('update', $this->_role);

        $this->permissions = config('role.permission');

        $fillable = config('fillable.role');

        $role = $this->role->find($id);
        if ($role == null) {

            $msg = $this->getMessage(false, '', 'Quyền không tồn tại!');
            return redirect()->route('backend.systems.roles.index')->with($msg);
        }

        if (
            !$request->has($this->permissions['INDEX']) && !$request->has($this->permissions['SHOW'])
            && !$request->has($this->permissions['CREATE']) && !$request->has($this->permissions['EDIT'])
            && !$request->has($this->permissions['DELETE']) && !$request->has($this->permissions['CENSOR'])
            && !$request->has($this->permissions['INDEXALL'])
        ) {

            $msg = $this->getMessage(false, '', 'Vui lòng tick chọn các quyền của ứng dụng trước khi lưu!');

            return redirect()->route('backend.systems.roles.edit', $role->id)->with($msg);
        }



        if ($request->has('status') == false)
            $request->merge(['status' => '0']);

        $request->merge(
            [
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]
        );

        $data = $this->getFilterData($request, $fillable);

        DB::beginTransaction();
        try {
            // unset($data['updated_by']);
            $result = $this->role->update($role->id, $data);
            if (!$result) {
                DB::rollback();
                $msg = $this->getMessage($result, '', 'Cập nhật quyền thất bại!');
                return redirect()->route('backend.systems.roles.edit', $role->id)->with($msg);
            }

            $role = $this->role->find($result->id);

            //dd($request->index);
            if (!$this->insertPermissions($request, $role)) {

                $msg = $this->getMessage(false, '', 'Cập nhật quyền thất bại!');
                DB::rollback();
                return redirect()->route('backend.systems.roles.edit', $role->id)->with($msg);
            }

            $msg = $this->getMessage($result, 'Cập nhật quyền thành công!', '');

            DB::commit();
            return redirect()->route('backend.systems.roles.index')->with($msg);
        } catch (Exception $e) {

            DB::rollback();
            $msg = $this->getMessage(false, '', 'Đã có lỗi trong Exception!');
            return redirect()->route('backend.systems.roles.edit', $id)->with($msg);
        }
    }

    //Thêm 1 field vào request
    private function mergeRequest($request, $nameRequest, $value)
    {
        return $request->merge([$nameRequest => $value]);
    }

    private function getFilterData($request, $fillable)
    {
        //strlen là lấy cả số 0
        return array_filter($request->only($fillable), 'strlen');
    }

    private function insertPermissions($request, $role)
    {
        if ($role->getPermissions()->count() != null) {
            $result = $role->getPermissions()->delete();
            if (!$result) {
                return false;
            }
        }

        foreach ($request->menuId as $menu) {

            $indexAll = $this->checkExistPermission($request->indexAll, $menu) ? '1' : '0';
            $index = $this->checkExistPermission($request->index, $menu) ? '1' : '0';
            $show = $this->checkExistPermission($request->show, $menu) ? '1' : '0';
            $create = $this->checkExistPermission($request->create, $menu) ? '1' : '0';
            $edit = $this->checkExistPermission($request->edit, $menu) ? '1' : '0';
            $delete = $this->checkExistPermission($request->delete, $menu) ? '1' : '0';
            $censor = $this->checkExistPermission($request->censor, $menu) ? '1' : '0';

            $data = [
                'role_id' => $role->id,
                'menu_id' => $menu,
                'indexAll' => $indexAll,
                'index' => $index,
                'show' => $show,
                'create' => $create,
                'edit' => $edit,
                'delete' => $delete,
                'censor' => $censor,
            ];

            $result = $role->getPermissions()->insert($data);
            if (!$result) {
                return false;
            }
        }

        return true;
    }

    private function checkExistPermission($permissions, $value)
    {
        if ($permissions == null)
            return false;
        foreach ($permissions as $p) {
            if ($p == $value)
                return true;
        }
        return false;
    }
}
