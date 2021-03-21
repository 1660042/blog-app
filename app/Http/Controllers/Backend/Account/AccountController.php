<?php

namespace App\Http\Controllers\Backend\Account;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Account\AccountRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct(AccountRepositoryInterface $account)
    {
        $this->account = $account;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('backend.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {

        if ($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ];

        $result = $this->account->create($data);

        $message = $this->getMessage($result, 'Tạo tài khoản thành công!', 'Tạo tài khoản thất bại!');

        return redirect()->route('backend.accounts.index')->with($message);
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
        $account = $this->account->find($id);
        //dd($account);
        if ($account == null) {
            $msg = $this->getMessage(false, '', 'Tài khoản không tồn tại! Vui lòng kiểm tra lại!');
            return redirect()->route('backend.accounts.index')->with($msg);
        }

        return view('backend.account.edit', compact('account'));
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

        $result = $this->account->update($id, $data);
        $msg = $this->getMessage($result, 'Cập nhật tài khoản thành công!', 'Cập nhật tài khoản thất bại, vui lòng kiểm tra lại!');

        return redirect()->route('backend.accounts.index')->with($msg);
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
}
