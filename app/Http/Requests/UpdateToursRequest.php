<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToursRequest extends FormRequest
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
        return [
            'precio' => ' numeric|min:50.0|max:3000',
            'precioprivado' => ' numeric|min:50.0|max:6000',
            'dificultad' => 'required|string|max:15',
            'hinicio' => ['required',    ],
            'hfin' => ['required',  ],
            'recomendaciones' => ['required', 'string', 'between:3,500', 'no_repeated_chars'],
            'llevar' => ['required', 'string', 'between:3,500', 'no_repeated_chars'],
            
        ];
    }
}
