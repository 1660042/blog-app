<?php

namespace App\Http\Requests\Backend\Post;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:posts,name,' . $this->id,
            'slug' => 'required|string|max:255|unique:posts,slug,' . $this->id,
            'path_image' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
            'category_id' => 'required|array|max:100',
            //tự custom 1 rule
            // 'category_id' => [
            //     function($attribute, $value, $fail) {
            //         if(is_numeric($value)) {
            //             return true;
            //         }
            //         $fail('Giá trị của :attribute không hợp lệ!');
            //     }
            // ],
            'status' => [
                function ($attribute, $value, $fail) {
                    if ($value == 1 || $value == '') {
                        return true;
                    }
                    $fail('Giá trị của :attribute không hợp lệ!');
                }
            ]
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
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên bài viết',
            'slug' => 'Đường dẫn bài viết',
            'category_id' => 'Chuyên mục',
            'status' => 'Trạng thái',
            'path_image' => 'Đường dẫn hình ảnh',
            'content' => 'Nội dung bài viết'
        ];
    }
}
