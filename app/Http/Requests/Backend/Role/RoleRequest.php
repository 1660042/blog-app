<?php

namespace App\Http\Requests\Backend\Role;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name,' . $this->id,
            'description' => 'nullable|string|max:255',
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
            'name' => 'Tên quyền',
            'description' => 'Mô tả quyền',
            'menuId' => 'Bảng quyền'
        ];
    }
}
