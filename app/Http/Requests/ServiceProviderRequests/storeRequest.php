<?php

namespace App\Http\Requests\ServiceProviderRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
            'shop_name'  => ['required', 'string', 'max:100'],
            'thumbnail' => ['sometimes','image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'description' => ['required', 'string', 'min:20', 'max:225'],
            'state_id' =>['required','exists:states,id'],
            'city_id' =>['required','exists:cities,id'],
            'phone_number' =>['required','string','max:10'],
            'whatsapp' =>['nullable','string','max:10'],
            'facebook' => ['nullable','url'],
            'instagram' => ['nullable','url'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => __('validation.provider_name_required'),
            'name.string' => __('validation.provider_name_string'),
            'name.max' => __('validation.provider_name_max'),

            'category_id.required' => __('validation.category_required'),
            'category_id.exists' => __('validation.category_exists'),

            'sub_category_id.required' => __('validation.subcategory_required'),
            'sub_category_id.exists' => __('validation.subcategory_exists'),

            'shop_name.required' => __('validation.shop_name_required'),
            'shop_name.string' => __('validation.shop_name_string'),
            'shop_name.max' => __('validation.shop_name_max'),

            'thumbnail.image' => __('validation.thumbnail_image'),
            'thumbnail.mimes' => __('validation.thumbnail_mimes'),
            'thumbnail.max' => __('validation.thumbnail_max'),

            'description.required' => __('validation.description_required'),
            'description.string' => __('validation.description_string'),
            'description.min' => __('validation.description_min'),
            'description.max' => __('validation.description_max'),

            'state_id.required' => __('validation.state_required'),
            'state_id.exists' => __('validation.state_exists'),

            'city_id.required' => __('validation.city_required'),
            'city_id.exists' => __('validation.city_exists'),

            'phone_number.required' => __('validation.phone_required'),
            'phone_number.string' => __('validation.phone_string'),
            'phone_number.max' => __('validation.phone_max'),

            'whatsapp.string' => __('validation.whatsapp_string'),
            'whatsapp.max' => __('validation.whatsapp_max'),
        ];
    }


}
