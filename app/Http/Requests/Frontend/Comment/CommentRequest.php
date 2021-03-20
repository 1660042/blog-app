<?php

namespace App\Http\Requests\Frontend\Comment;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CommentRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'website' => 'max:50',
            'content' => 'required|string|max:2000',
            'post_id' => 'integer',
            'answer_comment_id' => 'integer',
            // tự custom 1 rule
            // 'category_id' => [
            //     function($attribute, $value, $fail) {
            //         if(is_numeric($value)) {
            //             return true;
            //         }
            //         $fail('Giá trị của :attribute không hợp lệ!');
            //     }
            // ],
            // 'status' => [
            //     function ($attribute, $value, $fail) {
            //         if ($value == 1 || $value == '') {
            //             return true;
            //         }
            //         $fail('Giá trị của :attribute không hợp lệ!');
            //     }
            // ]
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
            'name' => 'Tên người bình luận',
            'email' => 'Địa chỉ email',
            'website' => 'Website',
            'content' => 'Nội dung bình luận',
            'post_id' => 'Bài viết',
            'answer_comment_id' => 'Người bình luận'
        ];
    }
}
