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
            'type_card' => 'required',         
            'avatar' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_card.required' => 'Vui lòng nhập tên thẻ',
            'name_card.max' => 'Giới hạn 150 ký tự',
            'type_card.required' => 'Vui lòng nhập loại thẻ',
            'avatar.required' => 'Vui lòng chọn ảnh game',
        ];
    }
}
