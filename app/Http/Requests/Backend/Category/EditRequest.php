<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:category,name,'.$this->id,
            'url_page' => 'required|string|max:255|max:255|unique:category,url_page,'.$this->id,
            //tự custom 1 rule
            'parent_id' => [
                function($attribute, $value, $fail) {
                    if(is_numeric($value) || $value == '') {
                        return true;
                    }
                    $fail('Giá trị của :attribute không hợp lệ!');
                }
            ],
            'status' => [
                function($attribute, $value, $fail) {
                    if($value == 1 || $value == '') {
                        return true;
                    }
                    $fail('Giá trị của :attribute không hợp lệ!');
                }
            ]
        ];
    }

    public function messages() {

        return [
            'required' => ':attribute không được để trống!',
            'string' => 'Bạn vui lòng nhập kiểu chuỗi cho '. Str::lower(':attribute') . '!',
            'max' => 'Bạn đã nhập ' . Str::lower(':attribute') . ' quá giới hạn ký tự cho phép!',
            'unique' => ':attribute đã tồn tại trong hệ thống!',
            'integer' => 'Bạn vui lòng nhập số cho '. Str::lower(':attribute') . '!',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên chuyên mục',
            'url_page' => 'Đường dẫn chuyên mục',
            'parent_id' => 'Chuyên mục cha',
            'status' => 'Trạng thái'
        ];
}
}
