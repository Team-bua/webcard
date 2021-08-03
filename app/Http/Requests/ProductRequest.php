<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:150',
            'game_opt' => 'required',         
            'content' => 'required',
            'avatar' => 'required',
            'thumbnail' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên game',
            'name.max' => 'Giới hạn 150 ký tự',
            'game_opt.required' => 'Vui lòng nhập hệ điều hành hổ trợ nạp',
            'content.required' => 'Vui lòng nhập mô tả game',
            'avatar.required' => 'Vui lòng chọn ảnh game',
            'thumbnail.required' => 'Vui lòng chọn ảnh thumbnail',
        ];
    }
}
