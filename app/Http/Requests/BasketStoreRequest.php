<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Employee;

class EmployeeStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'active' => 'required|integer|digits_between:0,1',
                    'order_id' => 'required|integer|max:11',
                ];
        }
    }

    public function messages()
    {
        return [
            'name' => [
              'required' => 'Поле Name не заполнено',
              'string' => 'Должно состоять полностью из букв',
              'max' => 'Максимально 255 символов',
            ],
            'active' => [
              'required' => 'Поле active не заполнено',
              'integer' => 'Должно быть целым числом',
              'digits_between' => 'Должно быть 0 или 1',
            ],
            'order_id' => [
                'required' => 'Поле order_id не заполнено',
                'integer' => 'Должно быть целым числом',
                'max' => 'Максимально 11 символов',
            ],
        ];
    }
}
