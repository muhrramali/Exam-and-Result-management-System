<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $teacher = $this->route('teacher');
        $userId = $teacher?->user_id;

        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:6'],
            'Full_Name' => ['required', 'string', 'max:100'],
            'Qualification' => ['nullable', 'string', 'max:100'],
            'Contact' => ['nullable', 'string', 'max:50'],
        ];
    }
}
