<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TargetWeightRequest extends FormRequest
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
            'target_weight' => ['required', 'numeric', 'max:9999', 'regex:/^\d{1,4}(\.\d{1})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.max' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
