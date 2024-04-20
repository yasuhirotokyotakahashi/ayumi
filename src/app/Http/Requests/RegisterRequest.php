<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique|string|max:191',
            'password' => 'required|min:8|max:191',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'お客様名は必須項目です。',
            'name.string' => 'お客様名は文字列で入力してください。',
            'name.max' => 'お客様名は191文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.max' => 'メールアドレスは191文字以内で入力してください。',
            'password.required'  => 'パスワードは必須項目です。',
            'password.max' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは191文字以内で入力してください。',


        ];
    }
}
