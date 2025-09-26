<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => ['required','min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/', 'confirmed'],
        ];
    }

    public function messages(): array
{
    return [
        'current_password.required' => 'Please enter your current password.',
        'current_password.string' => 'Your current password must be a valid string.',

        'password.required' => 'Please enter a new password.',
        'password.min' => 'Your new password must be at least 8 characters long.',
        'password.regex' => 'Your password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'password.confirmed' => 'The password confirmation does not match.',
    ];
}

}
