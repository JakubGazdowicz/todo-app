<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'string',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'max:255',
                Rules\Password::defaults()
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Pole nazwa użytkownika jest wymagane',
            'name.string' => 'Pole nazwa użytkownika jest musi być ciągiem znaków',
            'name.max' => 'Pole nazwa użytkownika nie może przekraczać :max znaków',
            'email.required' => 'Pole email jest wymagane',
            'email.string' => 'Pole email jest musi być ciągiem znaków',
            'email.max' => 'Pole email nie może przekraczać :max znaków',
            'email.email' => 'Pole email musi być poprawnym adresem email',
            'password.required' => 'Pole hasło jest wymagane',
            'password.string' => 'Pole hasło jest musi być ciągiem znaków',
            'password.max' => 'Pole hasło nie może przekraczać :max znaków',
            'password.min' => 'Pole hasło musi mieć minimum :min znaków',
        ];
    }
}
