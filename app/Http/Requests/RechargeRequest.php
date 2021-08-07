<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RechargeRequest extends FormRequest
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
            'money' => 'required|gte:0',        
        ];
    }

    public function messages()
    {
        return [
            'money.required' => 'Vui lòng nhập số tiền',
            'money.gte' => 'Số tiền phải lớn hơn 0'
        ];
    }
}
