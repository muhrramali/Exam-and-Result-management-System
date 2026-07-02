<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $student = $this->route('student');
        $userId = $student?->user_id;

        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:6'],
            'Roll_No' => ['required', 'string', 'max:20', Rule::unique('students', 'Roll_No')->ignore($student?->Student_ID, 'Student_ID')],
            'Full_Name' => ['required', 'string', 'max:100'],
            'Date_Of_Birth' => ['nullable', 'date'],
            'Gender' => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
            'Contact' => ['nullable', 'string', 'max:50'],
            'Section_ID' => ['nullable', 'exists:sections,Section_ID'],
        ];
    }
}
