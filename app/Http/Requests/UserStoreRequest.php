<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'login' => 'required|max:30|min:3|unique:App\Models\User,login',
            'name' => 'required|max:50|min:2',
            'email' => 'required|email|max:255|min:5|unique:App\Models\User,email',
            'password' => 'required|max:255|min:6',
            'address' => 'required|max:255|min:5',
            'number' => 'required|regex:/^\+?7\d{10}$/|unique:App\Models\User,number',
            'is_admin' => 'nullable|boolean',
            'ava' => 'nullable|file|mimes:jpg,png'
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'login' => [
                        'required',
                        'max:30',
                        'min:3',
                        Rule::unique('users')->ignore($this->login, 'login')
                    ],
                    'name' => 'required|max:50|min:2',
                    'email' => [
                        'required',
                        'email',
                        'max:255',
                        'min:5',
                        Rule::unique('users')->ignore($this->name, 'name')
                    ],
                    'password' => 'required|max:255|min:6',
                    'address' => 'required|max:255|min:5',
                    'number' => [
                        'required',
                        'regex:/^\+?7\d{10}$/',
                        Rule::unique('users')->ignore($this->number, 'number')
                    ],
                    'is_admin' => 'nullable|boolean',
                    'ava' => [
                        'file' => 'Ошибка с файлом изображения',
                        'mimes' => 'Формат файла изображения должен быть: .jpg .png',
                    ],
                ];
        }
    }

    public function messages()
    {
        return [
            'login' => [
              'required' => 'Поле Login не заполнено',
              'max' => 'Поле Login должно быть не больше 50',
              'min' => 'Поле Login должно быть не меньше 3',
              'unique' => 'Login уже занят',
          ],
            'name' => [
                'required' => 'Поле Name не заполнено',
                'max' => 'Поле Name должно быть не больше 50',
                'min' => 'Поле Name должно быть не меньше 2',
            ],
            'email' => [
                'required' => 'Поле Email не заполнено',
                'max' => 'Поле Email должно быть не больше 255',
                'min' => 'Поле Email должно быть не меньше 6',
                'email' => 'Почта указана некорректно',
                'unique' => 'Почта уже занята',
            ],
            'password' => [
                'required' => 'Поле Password не заполнено',
                'max' => 'Поле Password должно быть не больше 255',
                'min' => 'Поле Password должно быть не меньше 6',
            ],
            'address' => [
                'required' => 'Поле Address не заполнено',
                'max' => 'Поле Address должно быть не больше 255',
                'min' => 'Поле Address должно быть не меньше 5',
            ],
//            'number' => [
//                'required' => 'Поле Number не заполнено',
//                'integer' => 'Неправильно указан номер',
//                'max' => 'Поле Number должно быть не больше 11',
//                'min' => 'Поле Number должно быть не меньше 11',
//                'unique' => 'Данный номер уже занят',
//                'numeric' => 'Номер должен состоять только из цифр',
//            ],
            'number' => [
                'required' => 'Поле Number не заполнено',
                'unique' => 'Данный номер уже занят',
                'regex' => 'Номер должен быть по типу: +7XXXXXXXXXX',
            ],
            'ava' => [
                'file' => 'Ошибка с файлом изображения',
                'mimes' => 'Формат файла изображения должен быть: .jpg .png',
            ],
        ];
    }
}
//'photo' => 'mimes:jpg,bmp,png'
