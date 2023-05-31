<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Employee;

class EmployeeStoreRequest1 extends FormRequest
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
            'employee_id' => 'required|integer|exists:employees,id',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'name' => 'required|string|max:255',
                ];
        }
    }

    public function messages()
    {
        return [
            'employee_id' => [
              'required' => 'Поле employee_id не заполнено',
              'integer' => 'Должно быть целым числом',
              'exists' => 'Такого доставщика нет',
            ],
            'name' => [
                'required' => 'Поле Name не заполнено',
                'string' => 'Должно состоять полностью из букв',
                'max' => 'Максимально 255 символов',
            ],
        ];
    }
}
