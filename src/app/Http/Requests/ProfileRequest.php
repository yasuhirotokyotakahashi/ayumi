<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'postcode' => 'required|numeric',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'ニックネームは必須項目です。',
            'postcode.required' => '郵便番号は必須項目です。',
            'postcode.numeric' => '郵便番号は数値で入力してください。',
            'address.required' => 'お客様ご住所は必須項目です。',
        ];
    }
}
