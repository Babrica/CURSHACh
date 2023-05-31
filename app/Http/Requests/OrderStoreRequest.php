<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'user_id' => 'required|integer|max:11|exists:users,id',
            'product_id' => 'required|max:11|integer|exists:products,id',
            'address' => 'nullable|min:5|max:255',
            'employee_id' => 'nullable|max:11|integer|exists:employees,id',
        ];
    }

    public function messages()
    {
        return [
            'user_id' => [
              'required' => 'Ошибка id пользователя',
              'integer' => 'Должно быть целым числом',
              'exists' => 'Пользователь не найден',
              'max:11' => 'id должно быть не больше 11',
            ],
            'product_id' => [
                'required' => 'Ошибка id продукта',
                'integer' => 'Должно быть целым числом',
                'exists' => 'Продукт не найден',
                'max:11' => 'id должно быть не больше 11',
            ],
            'address' => [
                'max' => 'Адрес должен быть не больше 255 символов',
                'min' => 'Адрес должен быть не меньше 5 символов',
            ],
            'employee_id' => [
                'required' => 'Ошибка id доставщика',
                'integer' => 'Должно быть целым числом',
                'exists' => 'Доставщик не найден',
                'max:11' => 'id должно быть не больше 11',
            ],
        ];
    }
}
