<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'name_card' => 'required|max:150',        
            'avatar' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'discount' => 'gte:0',
        ];
    }

    public function messages()
    {
        return [
            'name_card.required' => 'Vui lòng nhập tên thẻ',
            'name_card.max' => 'Giới hạn 150 ký tự',
            'avatar.required' => 'Vui lòng chọn ảnh game',
            'avatar.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
            'avatar.max' => 'Giới hạn ảnh 2Mb',
            'discount.gte' => 'Giá trị phải lớn hơn 0'
        ];
    }
}
