<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;


class StoreProductosRequest extends FormRequest
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
            'precio' => 'required|numeric|min:0.1|max:500',
            'descripcion' => ['required', 'string', 'between:4,500', 'no_repeated_chars'],
            'categoria' => 'required|string|max:30',
            'cantidad' => 'required|integer|min:1|max:100',
            'foto' => 'required',    
        ];
    }
}
