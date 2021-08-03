<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' =>'required|max:150',
            'avatar' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Giới hạn 150 ký tự',
            'avatar.required' => 'Vui lòng nhập ảnh',
            'avatar.mimes' => 'Chỉ những hình ảnh gắn thẻ có đuôi .jpg .jpeg .png .gif mới được chấp nhận',
            'avatar.max' => 'Giới hạn dung lượng không quá 2M',
        ];
    }
}
