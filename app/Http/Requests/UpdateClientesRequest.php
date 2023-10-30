<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientesRequest extends FormRequest
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
            'apellido' => ['required', 'string', 'between:3,20', 'no_repeated_chars'],
            'hotel' => ['nullable','string', 'between:3,20','no_repeated_chars', ],
            'nroom' => 'sometimes', 'integer|min:1|max:100',
            'whatsapp' => 'required|string|max:15',
            'dni' => 'required|string|max:20',
            'nacionalidad' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'altura' => 'required|numeric|min:0.01|max:2.50',
            'genero' => 'required',
           
            'alergia' => ['required', 'string', 'between:3,20', 'no_repeated_chars'],
            'fnacimiento' => 'required|date|before:' . Carbon::now()->subYears(10)->format('Y-m-d'),
            'alimento_id' => 'required',
        ];
    }
}
