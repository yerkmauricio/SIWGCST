<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRecibosRequest extends FormRequest
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
            'finicio' => 'required|date|after_or_equal:' . Carbon::now()->subDays(1)->format('Y-m-d') . '|before:' . Carbon::now()->addMonths(6)->format('Y-m-d'),
            'cuenta' => 'integer|min:50|max:6000',
            'tour_id'=>'required',
            'tipo'=>'required',
            'descuento_id'=>'required',
            'metodo' => 'required|string|max:30',
            'estado' => 'required',
            
        ];
    }
}
