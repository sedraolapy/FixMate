<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contactUsRequest extends FormRequest
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
            'user_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:10' ,'regex:/^\+?[0-9\s\-]{7,20}$/'],
            'message' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required' => 'Please enter your name.',
            'user_name.string' => 'Your name must be a valid text.',
            'user_name.max' => 'Your name cannot exceed 255 characters.',

            'phone_number.required' => 'Please enter your phone number.',
            'phone_number.string' => 'Your phone number must be valid.',
            'phone_number.regex' => 'Please enter a valid phone number format.',

            'message.required' => 'Please enter your message.',
            'message.string' => 'Your message must be valid text.',
            'message.max' => 'Your message cannot exceed 1000 characters.',
        ];

    }
}
