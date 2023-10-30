<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
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
            'tour_id'=>'required',
            
        ];
    }
}
