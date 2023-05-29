<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:50',
            'info' => 'required|max:255',
            'img' => 'required',
            'price' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'category' => 'required|min:3|max:10'
        ];
    }

    public function messages()
    {
        return [
            'name' => [
              'required' => 'Поле Name не заполнено',
              'min' => 'Поле Name должно быть не меньше 3',
              'max' => 'Поле Name должно быть не больше 50',
            ],
            'info' => [
                'required' => 'Поле Info не заполнено',
                'max' => 'Поле Info должно быть не больше 255',
            ],
            'img' => [
                'required' => 'Поле Img не заполнено',
            ],
            'price' => [
                'numeric' => 'Поле Price должно содержать только числа',
            ],
            'price_sale' => [
                'numeric' => 'Поле Price_sale должно содержать только числа',
            ],
            'category' => [
                'required' => 'Поле Category не заполнено',
                'min' => 'Поле Category должно быть не меньше 3',
                'max' => 'Поле Category должно быть не больше 10',
            ]
        ];
    }
}
