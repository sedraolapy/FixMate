<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class forgetPasswordRequest extends FormRequest
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
            'phone_number' => ['required','string','max:10']
        ];
    }


    public function messages(): array
    {
        return [
            'phone_number.required' => __('validation.phone_number_required'),
            'phone_number.string' => __('validation.phone_number_string'),
            'phone_number.max' => __('validation.phone_number_max'),
        ];
    }
}
