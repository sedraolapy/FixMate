<?php

namespace App\Http\Requests\Auth\VerifyCustomer;

use Illuminate\Foundation\Http\FormRequest;

class VerificationRequest extends FormRequest
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

     protected function prepareForValidation()
    {
    $this->merge([
        'verification_code' => implode('', $this->input('code', [])),
    ]);
    }


    public function rules(): array
    {
        return [
            'verification_code' => ['required', 'max:4'],
        ];
    }
}
