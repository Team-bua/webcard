<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardStoreRequest extends FormRequest
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
            'price_card' => 'required|numeric',
            'id_card' => 'required|max:150',
            'code_card' => 'required|max:150',     
        ];
    }

    public function messages()
    {
        return [
            'name_card.required' => 'Vui lòng nhập tên thẻ',
            'name_card.max' => 'Giới hạn 150 ký tự',
            'price_card.required' => 'Vui lòng nhập giá thẻ',
            'price_card.max' => 'Giới hạn 150 ký tự',
            'price_card.numeric' => 'Giá phải là số',
            'id_card.required' => 'Vui lòng nhập số seri thẻ',
            'id_card.max' => 'Giới hạn 150 ký tự',
            'code_card.required' => 'Vui lòng nhập mã thẻ',
            'code_card.max' => 'Giới hạn 150 ký tự',
        ];
    }
}
