<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *  @return bool
     */

    public function authorize()
    {
        return true; //roles y permiso 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed> \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules() //las validaciones 
    {
        return [
            'nombre' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'apellidopaterno' => ['required', 'string', 'between:3,20', 'no_repeated_chars'],
            'apellidomaterno' => ['required', 'string', 'between:3,20', 'no_repeated_chars'],
            'dni' => 'required|string|max:20|unique:empleados',
            'domicilio' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'nacionalidad' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'genero' => 'required',
            'whatsapp' => 'required|string|max:15',
            'fnacimiento' => 'required|date|before:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'foto' => 'required',
            'cargo_id' => 'required',
            'n_jerarquico_id' => 'required',
        ];
    }
}
