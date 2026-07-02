<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'Class_Name' => ['required', 'string', 'max:50'],
            'Capacity' => ['required', 'integer', 'min:1', 'max:200'],
            'Academic_Year_ID' => ['required', 'exists:academic_years,Year_ID'],
        ];
    }
}
