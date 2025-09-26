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
            'phone_number' =>['required','string','max:10'],
            'state_id' =>['required','exists:states,id'],
            'city_id' =>['required','exists:cities,id'],
            'password' => ['required','min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/', 'confirmed'],
            'terms'=> ['accepted']
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __('validation.first_name_required'),
            'last_name.required' => __('validation.last_name_required'),
            'phone_number.required' => __('validation.phone_required'),
            'phone_number.max' => __('validation.phone_max'),
            'phone_number.unique' => __('validation.phone_unique'),
            'state_id.required' => __('validation.state_required'),
            'state_id.exists' => __('validation.state_invalid'),
            'city_id.required' => __('validation.city_required'),
            'city_id.exists' => __('validation.city_invalid'),
            'password.required' => __('validation.password_required'),
            'password.min' => __('validation.password_min'),
            'password.confirmed' => __('validation.password_confirmed'),
            'password.regex' => __('validation.password_regex'),
            'terms.accepted' => __('validation.terms_accepted'),
        ];
    }


}
