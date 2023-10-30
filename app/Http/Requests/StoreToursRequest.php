<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreToursRequest extends FormRequest
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
            'ndia' => 'required|integer|min:1|max:10',
            'dificultad' => 'required|string|max:15',
            'hinicio' => ['required', 'date_format:H:i' ],
            'hfin' => ['required', 'date_format:H:i'],
            'recomendaciones' => ['required', 'string', 'between:3,500', 'no_repeated_chars'],
            'llevar' => ['required', 'string', 'between:3,500', 'no_repeated_chars'],
            'destino_id' => 'required',
             //'lisali_id'=> 'required',
             //'transporte_id' => 'required',
             //'hospedaje_id' => 'required',
            'obs_include_id' => 'required',
            'obs_noinclude_id' => 'required',
            'foto_tour_id' => 'required',
            'guia'=>'required|integer|min:50|max:500',
            'utilidad'=>'required|integer|min:1|max:100',
            'personas'=>'required|integer|min:4|max:50'
            
        ];
    }
}
