<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $this->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id,
            // 'password' => 'required|string|confirmed|min:6',
            'password' => $this->keepPassword != 1 ? 'required|string|min:6' : "",
        ];
    }

    public function messages()
    {

        return [
            'required' => ':attribute không được để trống!',
            'string' => 'Bạn vui lòng nhập kiểu chuỗi cho ' . Str::lower(':attribute') . '!',
            'max' => 'Bạn đã nhập ' . Str::lower(':attribute') . ' quá giới hạn ký tự cho phép!',
            'unique' => ':attribute đã tồn tại trong hệ thống!',
            'integer' => 'Bạn vui lòng nhập số cho ' . Str::lower(':attribute') . '!',
            'email' => ':attribute phải là định dạng email!',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên tài khoản',
            'email' => 'Địa chỉ email',
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
        ];
    }
}
