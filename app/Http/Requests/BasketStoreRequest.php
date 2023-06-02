<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Employee;

class BasketStoreRequest extends FormRequest
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
        $rules = [
            'user_id' => 'required|integer|max:11|exists:users,id',
            'product_id' => 'required|max:11|integer|exists:products,id',
            'amount' => 'max:11|integer',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'amount' => 'required|max:11|integer',
                ];
        }
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
            'amount' => [
                'required' => 'Ошибка количества продукта',
                'integer' => 'Должно быть целым числом',
                'max:11' =>  'Должно быть не больше 11',
            ],
        ];
    }
}
