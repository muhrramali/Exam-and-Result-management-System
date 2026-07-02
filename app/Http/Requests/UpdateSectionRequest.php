<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'Section_Name' => ['required', 'string', 'max:10'],
            'Class_ID' => ['required', 'exists:classes,Class_ID'],
        ];
    }
}
