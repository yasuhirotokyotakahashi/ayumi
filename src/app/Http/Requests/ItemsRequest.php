<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
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
            'price' => 'required|numeric',
            'description' => 'required|min:20',
            'category_id' => 'required',
            'condition_id' => 'required',
            'img' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => '商品名は必須項目です。',
            'price.required' => '商品価格は必須項目です。',
            'price.numeric' => '商品価格は数値で入力してください。',
            'description.required' => '商品説明は必須です。',
            'description.min' => '商品説明は20文字以上で入力してください。',
            'category_id.required' => '商品のカテゴリーは必須項目です。',
            'condition_id.required' => '商品の状態は必須項目です。',
            'img.required' => '商品画像は必須項目です',
        ];
    }
}
