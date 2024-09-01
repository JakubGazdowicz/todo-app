<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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

            'description' => [
                'nullable',
                'string',
                'max:255',
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'max:9600',
                'min:0',
            ],

            'user_id' => [
                'nullable',
                'exists:App\Models\User,id'
            ],

            'task_category_id' => [
                'nullable',
                'exists:App\Models\TaskCategory,id'
            ],
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required' => 'Pole nazwa jest wymagane',
            'name.string' => 'Pole nazwa musi być ciągiem znaków',
            'name.max' => 'Pole nazwa nie może przekraczać :max znaków',

            'duration_minutes.required' => 'Pole przewidywany czas jest wymagane',
            'duration_minutes.min' => 'Pole przewidywany czas nie może być mniejsze niż :min minut',
            'duration_minutes.max' => 'Pole przewidywany czas nie może być większe niż :max minut',
        ];
    }
}
