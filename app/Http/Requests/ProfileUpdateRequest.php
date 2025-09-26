<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
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
            'image' => ['nullable', 'image', 'max:2048'],
            'state_id' =>['required','exists:states,id'],
            'city_id' =>['required','exists:cities,id'],
        ];
    }

    public function messages(): array
{
    return [
        'first_name.required' => 'First name is required.',
        'first_name.string' => 'First name must be a valid string.',
        'first_name.max' => 'First name may not be greater than 100 characters.',

        'last_name.required' => 'Last name is required.',
        'last_name.string' => 'Last name must be a valid string.',
        'last_name.max' => 'Last name may not be greater than 100 characters.',

        'image.image' => 'The uploaded file must be an image.',
        'image.max' => 'Image size must not exceed 2MB.',

        'state_id.required' => 'Please select a state.',
        'state_id.exists' => 'The selected state is invalid.',

        'city_id.required' => 'Please select a city.',
        'city_id.exists' => 'The selected city is invalid.',
    ];
}
}
