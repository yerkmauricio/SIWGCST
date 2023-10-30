<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransporteRequest extends FormRequest
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
            'tipo' => 'required|string|max:30',
            'empresa' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'npasajero' => 'required|integer|min:4|max:80',
            'precio' => 'required|numeric|min:50.0|max:10000',
            'whatsapp' => 'required|string|max:15',
            'foto' => 'required',
        ];
    }
}
