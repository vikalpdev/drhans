<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:10'],
            'email' => ['nullable', 'email', 'max:255'],
            'centre_id' => ['required', 'exists:centres,id'],
            'department' => ['required', 'string', 'max:255'],
            'specialist_id' => ['nullable', 'exists:specialists,id'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'string', 'max:20'],
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'website.prohibited' => 'Submission rejected.',
        ];
    }
}
