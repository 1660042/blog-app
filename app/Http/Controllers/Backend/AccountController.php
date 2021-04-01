<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct(AccountRepositoryInterface $account, RoleRepositoryInterface $role, User $user)
    {
        $this->account = $account;
        $this->role = $role;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($permissions = $this->user->hasPermissions('accounts.index', 'index'));
        $this->authorize('view', $this->user);
        $accounts = $this->account->getAll();

        $status = Config('status.status');

        return view('backend.account.index', compact('accounts', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->user);
        $roles = $this->role->getRolesActive();
        return view('backend.account.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $this->authorize('create', $this->user);
        if ($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        //dd('a1');

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ];

        DB::beginTransaction();
        try {
            $result = $this->account->create($data);
            if (!$result) {
                $message = $this->getMessage(false, '', 'Tạo tài khoản thất bại!');
                return redirect()->route('backend.accounts.accounts.create')->with($message);
            }

            $message = $this->insertUserRoles($request, $result);

            if (Str::length($message) > 0) {
                DB::rollback();
                $message = $this->getMessage(false, '', $message);
                return redirect()->route('backend.accounts.accounts.create')->with($message);
            }

            $message = $this->getMessage(true, 'Tạo tài khoản thành công!', '');

            DB::commit();
            return redirect()->route('backend.accounts.accounts.index')->with($message);
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            $message = $this->getMessage(false, '', 'Tạo tài khoản thất bại!');
            return redirect()->route('backend.accounts.accounts.create')->with($message);
        }



        $this->message = $this->getMessage($result, 'Tạo tài khoản thành công!', 'Tạo tài khoản thất bại!');

        return redirect()->route('backend.accounts.accounts.index')->with($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', $this->user);
        $account = $this->account->find($id);

        //dd($account->getRoles->where('status', '=', '1')[0]
        //->getPermissions->where('menu_id', '=', 4)->where('access', '=', '1')->first()->index);
        //dd($account->getRoles()->where('role_id', '=', 1)->first());

        //dd($account);
        if ($account == null) {
            $message = $this->getMessage(false, '', 'Tài khoản không tồn tại! Vui lòng kiểm tra lại!');
            return redirect()->route('backend.accounts.accounts.index')->with($message);
        }

        // /dd($account->getRoles()->where('role_id', '=', '1')->first());

        $roles = $this->role->getRolesActive();

        return view('backend.account.edit', compact('account', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterRequest $request, $id)
    {
        $this->authorize('update', $this->user);
        //dd($request->all());

        $account = $this->account->find($id);
        if ($account == null) {
            $message = $this->getMessage(false, '', 'Tài khoản cần cập nhật không tồn tại!');
            return redirect()->route('backend.accounts.accounts.index')->with($message);
        }

        if ($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ];

        if ($request->keepPassword == 1) {
            unset($data['password']);
        }

        DB::beginTransaction();
        try {
            $result = $this->account->update($id, $data);
            if ($result == false) {
                $message = $this->getMessage(false, '', 'Cập nhật tài khoản thất bại!');
                return redirect()->route('backend.accounts.accounts.edit', $id)->with($message);
            }
            $message = $this->insertUserRoles($request, $result);
            if (Str::length($message) > 0) {
                $message = $this->getMessage(false, '',  $message);
            }

            $message = $this->getMessage(true, 'Cập nhật tài khoản thành công!', '');
            $this->message = $this->getMessage($result, 'Cập nhật tài khoản thành công!', 'Cập nhật tài khoản thất bại, vui lòng kiểm tra lại!');
            DB::commit();
            return redirect()->route('backend.accounts.accounts.index')->with($this->message);
        } catch (Exception $e) {
            DB::rollback();
            $message = $this->getMessage(false, '', 'Đã có lỗi xảy ra trong quá trình cập nhật! Vui lòng báo Admin!');
            return redirect()->route('backend.accounts.accounts.edit', $id)->with($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function mergeRequest($request, $nameRequest, $value)
    {
        return $request->merge([$nameRequest => $value]);
    }

    private function getDefaultRole()
    {
        return $this->role->findRoleActive('code', 'Member', '=');
    }

    private function insertUserRoles($request, $account)
    {

        if ($request->has('role_id') == false) {
            //tìm quyền mặc định
            if ($this->getDefaultRole() == null) {

                return 'Không tìm thấy quyền Member mặc định! Vui lòng kiểm tra lại!';
            }
            $this->mergeRequest($request, 'role_id', $this->getDefaultRole()->id);
        }

        //dd($request->role_id);

        $account->getRoles()->detach();
        $account->getRoles()->attach($request->role_id);

        if (!$account->getRoles->contains($request->role_id)) {
            return 'Không thể tạo các dữ liệu quyền!';
        }
        return '';
    }
}
