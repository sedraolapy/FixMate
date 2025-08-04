<?php

namespace App\Http\Requests\Auth\Register;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'first_name' =>['required','string','max:100'],
            'last_name' =>['required','string','max:100'],
            'phone_number' =>['required','string','max:10','unique:customers,phone_number'],
            'state_id' =>['required','exists:states,id'],
            'city_id' =>['required','exists:cities,id'],
            'password' => ['required','min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/', 'confirmed'],
            'terms'=> ['accepted']
        ];
    }

    public function messages(): array
{
    return [
        'first_name.required' => 'Please enter your first name.',
        'last_name.required' => 'Please enter your last name.',
        'phone_number.required' => 'Phone number is required.',
        'phone_number.max' => 'Phone number cannot be more than 10 digits.',
        'phone_number.unique' => 'This phone number is already in use.',
        'state_id.required' => 'Please select a state.',
        'state_id.exists' => 'Selected state is invalid.',
        'city_id.required' => 'Please select a city.',
        'city_id.exists' => 'Selected city is invalid.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Password confirmation does not match',
        'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'terms.accepted' => 'You must accept the terms and conditions.',
    ];
}

}
