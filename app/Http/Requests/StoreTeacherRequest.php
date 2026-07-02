<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'Full_Name' => ['required', 'string', 'max:100'],
            'Qualification' => ['nullable', 'string', 'max:100'],
            'Contact' => ['nullable', 'string', 'max:50'],
        ];
    }
}
