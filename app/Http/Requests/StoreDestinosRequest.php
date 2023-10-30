<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinosRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'ubicacion' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'entrada' => 'required|numeric|min:0.1|max:1000',
            'categoria' => 'required|string|max:30',
            'descripcion' => ['required', 'string', 'between:3,500', 'no_repeated_chars'],
            'distancia' => 'required|numeric|min:0.01|max:10000',
            'altura' => 'required|numeric|min:0.01|max:10000',
            'clima' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'whatsapp' => 'required|string|max:15',
            'foto' => 'required'
        ];
    }
}
