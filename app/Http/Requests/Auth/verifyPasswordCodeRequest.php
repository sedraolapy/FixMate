<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class verifyPasswordCodeRequest extends FormRequest
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
            'verification_code' => ['required', 'digits:6'],
            'phone_number' => ['required', 'string'],
        ];
    }

    public function messages(): array
{
    return [
        'phone_number.required' => 'Phone number is required.',
        'verification_code.digits' => 'Verification code must be exactly 6 digits.',
    ];
}
}
